<?php
    // core configuration
    include_once "config/core.php";

    include_once 'config/database.php';
    include_once 'objects/log.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    //set the session value to false
    unset($_SESSION['logged_in']);
    
    //redirect to login page
    header("Location: {$home_url}");
?>