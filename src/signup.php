<?php
  include_once 'config/core.php';


  if($_POST){

    // include classes
    include_once 'config/database.php';
    include_once 'objects/user.php';
    include_once 'objects/log.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // initialize objects
    $user = new User($db);
    $log = new Log($db);
 
    // set user email to detect if it already exists
    $user->email=$_POST['email'];

    // check if email already exists
    if($user->emailExists()){
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    Oops! The email you tried already exists!
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }else{
        // set values to object properties
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];

         
        if($user->create()){
          // login user into dashboard if account has been created
          $email_exists = $user->emailExists();
          if ($email_exists && password_verify($_POST['password'], $user->password) ){
             
            $log->user_id = $user->id;
            $log->action = "You created account";
            $log->create();

            $_SESSION['user_id'] = $user->id;
            $_SESSION['logged_in'] = true;

            header("Location: {$home_url}");
         
          }
         
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Somwthing went wrong, please try again.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
        }
    }

  }

?>	




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>

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

    <form action="signup.php" method="post" class="flex justify-center">
        <div class="auth-container">
            <h2>Create an account.</h2>

            <div class="flex mt-5 joined-inputs" style="row-gap: 20px; column-gap: 20px;">
                <div>
                    <label class="col-form-label">Firstname</label>
                    <input type="text" name="firstname" class="form-control">
                </div>

                <div>
                    <label class="col-form-label">Lastname</label>
                    <input type="text" name="lastname" class="form-control">
                </div>
            </div>

            <div class="mt-3">
                <label class="col-form-label">Username</label>
                <input type="text" name="username" class="form-control">
            </div>

            <div class="mt-3">
                <label class="col-form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mt-3">
                <label class="col-form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary custom-btn">Create account</button>
            </div>
        </div>
    </form>

    <div class="flex justify-center auth-alt">
        <span>Already have an account? <a href="login.php">Login.</a></span>
    </div>


</body>
</html>