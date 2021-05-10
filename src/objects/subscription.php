<?php

// subscription object
class Subscription{

    // database connection and table name
    private $conn;
    private $table_name = "subscriptions";
 
    // object properties
    public $id;
    public $deposit;
    public $user_id;
    public $name;
    public $profit;
    public $status;
    public $created;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }


    // create new subscription record
    function create(){
     
        // to get time stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
        $this->status = 0;
        $this->profit = 0;

        
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    deposit = :deposit, 
                    name = :name, 
                    user_id = :user_id, 
                    profit = :profit, 
                    status = :status,
                    created = :created";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     

     
        // bind the values
        $stmt->bindParam(':deposit', $this->deposit);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':profit', $this->profit);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':created', $this->created);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            $_SESSION["plan_name"] = $this->name;
            $_SESSION["plan_deposit"] = $this->deposit;
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
                    deposit,
                    user_id,
                    name,
                    profit,
                    status,
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
    function readUserSubscriptions(){
     
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


    function readOne(){
 
        $query = "SELECT
                    deposit,
                    user_id,
                    name,
                    profit,
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
     
        $this->deposit = $row['deposit'];
        $this->user_id = $row['user_id'];
        $this->name = $row['name'];
        $this->profit= $row['profit'];
        $this->status= $row['status'];
        $this->created = $row['created'];
    }




    function update(){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    profit = :profit,
                    status = :status
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':profit', $this->profit);
        $stmt->bindParam(':status', $this->status);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }



    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }



}