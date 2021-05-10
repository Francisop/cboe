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

    // get id of user
    $get_id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing id.');
    
    // set user ID property
    $user->id = $get_id;
    
    // read the user details
    $user->readOne();


  // get 'action' value in url parameter to display corresponding prompt messages
  $action=isset($_GET['action']) ? $_GET['action'] : "";

  if($action == "error"){
      echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
              An error occurred, please try again.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
          </div>";
  }

  @include_once './header.php';


?>




      <div class="container mt-5">

          <div class="row mb-3">
              <div class="col"><h1>EDIT DETAILS</h1></div>
              <div class="col">
                  <a href="index.php"><span class="btn btn-primary">Back</span></a>
                  
                  <?php 

                      if($user->isActive == 1){
                          echo "<a href='user-block.php?id={$user->id}'><span class='btn btn-danger'>Block User</span></a>";
                      }else{
                          echo "<a href='user-block.php?id=$user->id'><span class='btn btn-success'>Unblock User</span></a>";
                      }


                  ?>
      
              </div>
          </div>

          <form action="user-update.php" method="POST">
              <table class="custom-table just-table">
                <tbody>

                  <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" class="form-control" value="<?php echo $user->username; ?> "></td>
                  </tr>

                  <tr>
                    <td>Firstname</td>
                    <td><input type="text" name="firstname" class="form-control" value="<?php echo $user->firstname; ?>"></td>
                  </tr>

                  <tr>
                    <td>Lastame</td>
                    <td><input type="text" name="lastname" class="form-control" value="<?php echo $user->lastname; ?>"></td>
                  </tr>

                  <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" class="form-control" value="<?php echo $user->email; ?>"></td>
                  </tr>

                  <tr class="bg-info">
                    <td><b>Balance</b></td>
                    <td><input type="text" name="acct_balance" class="form-control" value="<?php echo $user->acct_balance; ?>"></td>
                  </tr>

                  <tr class="bg-info">
                    <td><b>Referral Bonus</b></td>
                    <td><input type="text" name="referral_bonus" class="form-control" value="<?php echo $user->referral_bonus; ?>"></td>
                  </tr>

                  <tr>
                    <td>Wallet Address</td>
                    <td><input type="text" name="bitcoin_address" class="form-control" value="<?php echo $user->wallet_address; ?>"></td>
                  </tr>

                  <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">

                </tbody>
              </table>
              

              <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>

      <script>
        $(document).ready(function(){
            //Data tables
            $('#default-table').DataTable({
                "pageLength": 7,
                "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
            });

            $('.just-table').DataTable({
                searching: false,
                paging: false
            });
          })
      </script>

  </body>
</html>