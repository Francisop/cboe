<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $firstame;
    public $lastame;
    public $username;
    public $email;
    public $password;
    public $wallet_address;
    public $acct_balance;
    public $referral_bonus;
    public $isActive;
    public $created;
    public $modified;


 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

      // check if given email exist in the database
    function emailExists(){
 
            // query to check if email exists
            $query = "SELECT id, isActive, password
                    FROM " . $this->table_name . "
                    WHERE email = ?
                    LIMIT 0,1";
         
            // prepare the query
            $stmt = $this->conn->prepare( $query );
         
            // sanitize
            $this->email=htmlspecialchars(strip_tags($this->email));
         
            // bind given email value
            $stmt->bindParam(1, $this->email);
         
            // execute the query
            $stmt->execute();
         
            // get number of rows
            $num = $stmt->rowCount();
         
            // if email exists, assign values to object properties for easy access and use for php sessions
            if($num>0){
         
                // get record details / values
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                $this->password = $row['password'];
                $this->isActive = $row['isActive'];
                $this->id = $row['id'];
         
                // return true because email exists in the database
                return true;
            }
         
            // return false if email does not exist in the database
            return false;
        }

        // create new user record
      function create(){
     
        // to get time stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
        $this->isActive = 1;
        $this->acct_balance = 5;
        $this->referral_bonus = 0;
        $this->wallet_address = "";

        
        // insert query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET 
                    firstname = :firstname, 
                    lastname = :lastname, 
                    username = :username,  
                    email = :email, 
                    acct_balance = :acct_balance, 
                    referral_bonus = :referral_bonus, 
                    wallet_address = :wallet_address, 
                    isActive = :isActive,
                    password = :password,
                    created = :created";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);
     

     
        // bind the values
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':acct_balance', $this->acct_balance);
        $stmt->bindParam(':referral_bonus', $this->referral_bonus);
        $stmt->bindParam(':wallet_address', $this->wallet_address);
        $stmt->bindParam(':isActive', $this->isActive);
        $stmt->bindParam(':created', $this->created);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
     
      }




      // read all user records
    function readAll(){
     
        // query to read all user records
        $query = "SELECT
                    id,
                    firstname,
                    lastname,
                    username,
                    email,
                    acct_balance,
                    referral_bonus,
                    wallet_address,
                    isActive,
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


    // used for paging users
    public function countAll(){
     
        // query to select all user records
        $query = "SELECT id FROM " . $this->table_name . "";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        // get number of rows
        $num = $stmt->rowCount();
     
        // return row count
        return $num;
    }


    function readOne(){
 
        $query = "SELECT
                    firstname,
                    lastname,
                    username,
                    email,
                    password,
                    acct_balance,
                    referral_bonus,
                    wallet_address,
                    isActive,
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
     
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        $this->username = $row['username'];
        $this->email= $row['email'];
        $this->password= $row['password'];
        $this->acct_balance= $row['acct_balance'];
        $this->referral_bonus= $row['referral_bonus'];
        $this->wallet_address = $row['wallet_address'];
        $this->isActive = $row['isActive'];
        $this->created = $row['created'];
    }



    // insert user details
      function update(){
     
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    firstname = :firstname,
                    lastname = :lastname,
                    username = :username,
                    email = :email,
                    acct_balance = :acct_balance,
                    referral_bonus = :referral_bonus,
                    wallet_address = :wallet_address
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':acct_balance', $this->acct_balance);
        $stmt->bindParam(':referral_bonus', $this->referral_bonus);
        $stmt->bindParam(':wallet_address', $this->wallet_address);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }

     }


     function activeToggle(){
     
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    isActive = :isActive
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':isActive', $this->isActive);
        $stmt->bindParam(':id', $this->id);
     
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }

    }


    function checkBalSufficient($amount){
        if($this->acct_balance >= $amount){
            return true;
        }else{
            return false;
        }
    }

    function updatePassword($new_password){
        // insert query
        $query = "UPDATE
                    " . $this->table_name . "
                SET 
                    password = :password
                WHERE 
                    id = :id";
     
        // prepare the query
        $stmt = $this->conn->prepare($query);

     
        // bind the values
        $stmt->bindParam(':id', $this->id);

        //hash password before saving
        $password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);
     
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



    // delete the user
    function delete(){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);


        
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
     
     
}