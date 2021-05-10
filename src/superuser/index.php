<?php
  include_once '../config/core.php';

  // include classes
  include_once '../config/database.php';
  include_once '../objects/admin.php';

  // default to false
  $superuser_access=false;

  if($_POST){

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // initialize objects
    $admin = new Admin($db);
 
    // check if username and password are in the database
    $admin->username = $_POST['username'];
     
    // check if email exists, also get user details using this emailExists() method
    $username_exists = $admin->usernameExists();
     
    // validate login
    if ($username_exists && ($_POST['password'] === $admin->password) ){
       
       // if it is, set the session value to true

        $_SESSION['superuser_logged_in'] = true;

        header("Location: {$home_url}superuser/all-users.php");
   
    }
     
    // if username does not exist or password is wrong
    else{

        $superuser_access=true;
    }

  }


  //tell the user if access denied
   if($superuser_access){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Your username or password may be incorrect.
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

    //check if user is logged in
    if((isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] = true){
      header("Location: {$home_url}superuser/all-users.php");
    }

?>


<!DOCTYPE html >
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IG Brokers</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">

        <link href="../static/css/index.css" rel="stylesheet">

        <!-- JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    </head>
    <body>

		<div class="container mt-5" style="width: 500px">
			<div class="row mb-3">
				<div class="col"><h2>Admin Login</h2></div>
				<div class="col"><a href="../"><span class="btn btn-primary">Back</span></a></div>
			</div>

			<form method="POST" action="index.php">
			  <div class="form-group">
			    <label>Username</label>
			    <input type="text" class="form-control" name="username">
			  </div>
			  <div class="mt-3">
			    <label>Password</label>
			    <input type="password" class="form-control" name="password">
			  </div>
			  <button type="submit" class="btn btn-primary mt-3">Submit</button>
			</form>
		</div>

    <script src="../static/js/index.js"></script>


	</body>
</html>