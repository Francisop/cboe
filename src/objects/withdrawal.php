<?php

// withdrawal object
class Withdrawal{

    // database connection and table name
    private $conn;
    private $table_name = "withdrawals";
 
    // object properties
    public $id;
    public $amount;
    public $user_id;
    public $status;
    public $access_code;
    public $created;
    public $modified;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }


    // create new user record
    function create(){
     
        // to get time stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
        $this->status = "pending";
        $this->access_code = "";

        
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    amount = :amount, 
                    user_id = :user_id, 
                    status = :status,  
                    access_code = :access_code, 
                    created = :created";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     

     
        // bind the values
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->bindParam(':created', $this->created);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
     
    }


    //change witdrawal status
    function changeStatus(){
     
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    status = :status
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }

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
        $codeAlphabet= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[ $this->crypto_rand_secure(0, $max-1) ];
        }

        return $token;
    }


    //new access code
    function newAccessCode(){

        $this->access_code = $this->getToken(8);
     
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    access_code = :access_code
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':access_code', $this->access_code);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }

    }

    // read all records
    function readAll(){
     
        // query to read all user records
        $query = "SELECT
                    id,
                    amount,
                    user_id,
                    status,
                    access_code,
                    created
                FROM " . $this->table_name . "
                ORDER BY id DESC
                ";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // execute query
        $stmt->execute();
     
        // return values
        return $stmt;
    }


    // read all user subscriptions
    function readUserWithdrawals(){
     
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


    // read one withdrawal
    function readOne(){
     
        $query = "SELECT
                    amount,
                    user_id,
                    access_code,
                    status,
                    created
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->amount = $row['amount'];
        $this->user_id = $row['user_id'];
        $this->access_code = $row['access_code'];
        $this->status= $row['status'];
        $this->created= $row['created'];
    }



    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }



}