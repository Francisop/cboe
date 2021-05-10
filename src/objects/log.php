<?php

// plan object
class Log{

    // database connection and table name
    private $conn;
    private $table_name = "logs";
 
    // object properties
    public $id;
    public $log_id;
    public $user_id;
    public $action;
    public $created;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }


    // generate access code
    function crypto_rand_secure($min, $max){
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);
        return $min + $rnd;
    }

    function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[ $this->crypto_rand_secure(0, $max-1) ];
        }

        return $token;
    }


    // create new log record
    function create(){
     
        // to get time stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
        $this->log_id = $this->getToken(8);

        
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    log_id = :log_id, 
                    action = :action, 
                    user_id = :user_id, 
                    created = :created";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     

     
        // bind the values
        $stmt->bindParam(':log_id', $this->log_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':action', $this->action);
        $stmt->bindParam(':created', $this->created);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
     
    }

    // read all user logs
    function readUserLogs(){
     
        // query to read all user records
        $query = "SELECT
                    *
                FROM " . $this->table_name . "
                WHERE user_id = ?
                ORDER BY id DESC
                ";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->user_id);

        // execute query
        $stmt->execute();
     
        // return values
        return $stmt;
    }



    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

}