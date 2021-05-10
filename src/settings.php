<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Account Settings";
    $page_name = "settings";

    include_once 'objects/log.php';


    if($_POST){
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->wallet_address = $_POST['wallet_address'];

        if($user->update()){
            $log = new Log($db);
            $log->user_id = $user->id;
            $log->action = "Update account details";
            $log->create();

            header("Location: {$home_url}settings.php?action=user_updated");
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Oops. An error occured.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
            </div>";
        }
    }


    // get 'action' value in url parameter to display corresponding prompt messages
   $action=isset($_GET['action']) ? $_GET['action'] : "";

   //tell the user to login
   if($action == "user_updated"){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Your details have been updated successfully.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }

    if($action == "password_updated"){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                  Your password has been updated successfully.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
              </div>";
    }

    if($action == "old_password_incorrect"){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    The old password you entered is incorrect.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }

    if($action == "error"){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Oops. An error occured.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }
?>


<section class="flex no-ver-align page-parent">
    <?php
        include_once 'nav.php'
    ?>

    <main class="page-body">
      <?php include_once 'layouts/page-heading.php' ?>


      <section class="page-body-container">

        <div class="card large-card">
            <div class="card-header">Account Details</div>

            <div class="card-body">

                <form action="settings.php" method="post">
                    <div class="flex justify-between">
                        <label class="col-form-label">Full Name</label>
                        <input type="text" name="firstname" value="<?php echo $user->firstname; ?>" class="form-control small">
                        <input type="text" name="lastname" value="<?php echo $user->lastname; ?>" class="form-control small">
                    </div>

                    <div class="flex justify-between mt-5">
                        <label class="col-form-label">Username</label>
                        <input type="text" name="username" value="<?php echo $user->username; ?>" class="form-control large">
                    </div>

                    <!-- <div class="flex justify-between mt-5">
                        <label class="col-form-label">Phone Number</label>
                        <input type="tel" name="username" value="+1 348 9493 3043" class="form-control large">
                    </div> -->

                    <div class="flex justify-between mt-5">
                        <label class="col-form-label">Email Address</label>
                        <input type="email" name="email" value="<?php echo $user->email; ?>" class="form-control large">
                    </div>

                    <div class="flex justify-between mt-5">
                        <label class="col-form-label">Wallet Address</label>
                        <input type="text" name="wallet_address" value="<?php echo $user->wallet_address; ?>" class="form-control large">
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary custom-btn" type="button">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>



        <div class="card large-card mt-5">
            <div class="card-header">Change Password</div>

            <div class="card-body">

                <form action="change-password.php" method="post">
                    <div class="flex justify-between">
                        <label class="col-form-label">Old Password</label>
                        <input type="password" name="old_password" class="form-control large" required>
                    </div>

                    <div class="flex justify-between mt-5">
                        <label class="col-form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control large" required>
                    </div>

                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary custom-btn" type="button">Update Password</button>
                    </div>
                </form>

            </div>
        </div>
      </section>



    </main>
</section>




<?php 
    include_once 'footer.php';