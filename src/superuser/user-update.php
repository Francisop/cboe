<?php
  include_once '../config/core.php';

  //check if user is logged in
  if(!(isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] != true){
    header("Location: {$home_url}superuser/index.php?action=please_login");
  }

  // include classes
	include_once '../config/database.php';
	include_once '../objects/user.php'; 

  // get database connection
	$database = new Database();
	$db = $database->getConnection();
	 
	// prepare objects
	$user = new User($db);


  if($_POST){

    $user->id = intval($_POST['user_id']);
  	$user->username = $_POST['username'];
  	$user->firstname = $_POST['firstname'];
  	$user->lastname = $_POST['lastname'];
  	$user->email = $_POST['email'];
  	$user->acct_balance = $_POST['acct_balance'];
  	$user->referral_bonus = $_POST['referral_bonus'];
  	$user->wallet_address = $_POST['wallet_address'];

  	$edit_user = $user->update();

  	if($edit_user){
      header("Location: {$home_url}superuser/user-details.php?id={$user->id}&action=updated");
  	}
  }



?>