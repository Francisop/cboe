<?php 

class Admin{
 
    // database connection and table name
    private $conn;
    private $table_name = "admin";
 
    // object properties
    public $username;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

     // check if given email exist in the database
    function usernameExists(){
 
            // query to check if email exists
            $query = "SELECT password
                    FROM " . $this->table_name . "
                    WHERE username = ?
                    LIMIT 0,1";
         
            // prepare the query
            $stmt = $this->conn->prepare( $query );
         
            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
         
            // bind given email value
            $stmt->bindParam(1, $this->username);
         
            // execute the query
            $stmt->execute();
         
            // get number of rows
            $num = $stmt->rowCount();
         
            // if email exists, assign values to object properties for easy access and use for php sessions
            if($num>0){

                // get record details / values
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
                // assign values to object properties
                $this->password = $row['password'];
         
                // return true because email exists in the database
                return true;
            }
         
            // return false if email does not exist in the database
            return false;
        }

      }  