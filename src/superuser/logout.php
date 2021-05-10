<?php
    // core configuration
    include_once "../config/core.php";
    
    //set the session value to false
    unset($_SESSION['superuser_logged_in']);
    
    //redirect to login page
    header("Location: {$home_url}superuser/");
?>