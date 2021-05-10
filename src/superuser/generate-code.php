<?php
  include_once '../config/core.php';

  //check if user is logged in
  if(!(isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] != true){
    header("Location: {$home_url}superuser/index.php?action=please_login");
  }

  // include classes
    include_once '../config/database.php';
    include_once '../objects/withdrawal.php'; 

  // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare objects
    $withdrawal = new Withdrawal($db);

    // get id of user
    $get_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing id.');
    
    // set user ID property
    $withdrawal->id = $get_id;
   

    if($withdrawal->newAccessCode()){
        header("Location: {$home_url}superuser/withdrawals.php");
    }else{
        header("Location: {$home_url}superuser/withdrawals.php?action=code_generate_error");
    }

?>