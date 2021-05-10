<?php
    include_once 'config/core.php';

    //check if user is logged in
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] = true){
        header("Location: {$home_url}");
    }


    // include classes
    include_once 'config/database.php';
    include_once 'objects/user.php';
    include_once 'objects/log.php';

    // default to false
    $access_denied=false;


    if($_POST){

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
     
        // initialize objects
        $user = new User($db);
     
        // check if username and password are in the database
        $user->email = $_POST['email'];
         
        // check if username exists, also get user details using this emailExists() method
        $email_exists = $user->emailExists();
    
         
        // validate login
        if ($email_exists && password_verify($_POST['password'], $user->password) ){
               
            $_SESSION['user_id'] = $user->id;
            $_SESSION['logged_in'] = true;
    
            if($user->isActive == 0){
              unset($_SESSION['logged_in']);
            }
    
            header("Location: {$home_url}");
       
        }
         
        // if username does not exist or password is wrong
        else{
    
            $access_denied=true;
        }
    
    }

    //tell the user if access denied
    if($access_denied){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Access Denied!</strong> You email or password seems to be incorrect.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }


    // get 'action' value in url parameter to display corresponding prompt messages
    $action=isset($_GET['action']) ? $_GET['action'] : "";

    //tell the user to login
    if($action == "please_login"){
        echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                     Please login to continue.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,400;0,500;0,600;0,700;1,300&display=swap" rel="stylesheet">


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="static/css/index.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    

    <a href="./" class="auth-page logo flex justify-center">
        <img src="static/imgs/logo.png" alt="logo">
    </a>

    <form action="login.php" method="post" class="flex justify-center">
        <div class="auth-container">
            <h2>Login to your account.</h2>
            <div class="mt-5">
                <label class="col-form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mt-3">
                <label class="col-form-label">Password</label>
                <input type="password" name="password" class="form-control">
                <span class="fpass"><a href="">Forgot Password?</a></span>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary custom-btn">Continue</button>
            </div>
        </div>
    </form>

    <div class="flex justify-center auth-alt">
        <span>Don't have an account? <a href="signup.php">Create an account.</a></span>
    </div>


</body>
</html>