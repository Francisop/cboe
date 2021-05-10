<?php
    include_once 'config/core.php';

    // include classes
    include_once 'config/database.php';
    include_once 'objects/user.php'; 


    if($_POST){

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare objects
        $user = new User($db);

        //get user
        $user->id = $_SESSION["user_id"];
        $user->readOne();

        // check old password
        if(password_verify($_POST['old_password'], $user->password)){
            if($user->updatePassword($_POST['new_password'])){
                header("Location: {$home_url}settings.php?action=password_updated");
            }
            else{
                header("Location: {$home_url}settings.php?action=error");
            }
        }else{
            header("Location: {$home_url}settings.php?action=old_password_incorrect");
        }

        
        // set user ID property
        $withdrawal->id = $get_access;

        $withdrawal->readOne();
    }
 
  ?>