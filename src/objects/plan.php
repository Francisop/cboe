<?php

// plan object
class Plan{

    // database connection and table name
    private $conn;
    private $table_name = "plans";
 
    // object properties
    public $id;
    public $name;
    public $min_deposit;
    public $max_deposit;
    public $percent_profit;
    public $days_duration;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }


    // read all records
    function readAll(){
     
        // query to read all user records
        $query = "SELECT
                    id,
                    name,
                    min_deposit,
                    max_deposit,
                    percent_profit,
                    days_duration
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

    function readOne(){
 
        $query = "SELECT
                    id,
                    min_deposit,
                    max_deposit,
                    percent_profit,
                    days_duration
                FROM
                    " . $this->table_name . "
                WHERE
                    name = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->name);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->id = $row['id'];
        $this->min_deposit = $row['min_deposit'];
        $this->max_deposit = $row['max_deposit'];
        $this->percent_profit= $row['percent_profit'];
        $this->days_duration= $row['days_duration'];
    }

    function validateDeposit($amount){
        return (intval($amount) >= $this->min_deposit) && ($this->max_deposit >= intval($amount));
    }



    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }



}