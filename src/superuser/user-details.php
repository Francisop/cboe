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

  if($action == "updated"){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          User details was updated successfully.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
      </div>";
  }

  @include_once './header.php';

?>




      <div class="container mt-5">

          <div class="row mb-3">
              <div class="col"><h1>USER DETAILS</h1></div>
              <div class="col"><a href="index.php"><span class="btn btn-primary">Back</span></a></div>
          </div>


          <table class="custom-table just-table">
            <tbody>

              <tr>
                <td>Username</td>
                <td><b><?php echo $user->username; ?></b></td>
              </tr>

              <tr>
                <td>Firstname</td>
                <td><b> <?php echo $user->firstname; ?> </b></td>
              </tr>

              <tr>
                <td>Lastame</td>
                <td><b> <?php echo $user->lastname; ?> </b></td>
              </tr>

              <tr>
                <td>Email</td>
                <td><b><?php echo $user->email; ?> </b></td>
              </tr>

              <tr>
                <td>Account Balance</td>
                <td><b>$<?php echo $user->acct_balance; ?> </b></td>
              </tr>

              <tr>
                <td>Referral Bonus</td>
                <td><b>$<?php echo $user->referral_bonus; ?> </b></td>
              </tr>

              <tr>
                <td>Wallet Address</td>
                <td><b> <?php echo $user->wallet_address; ?> </b></td>
              </tr>

              <tr>
                <td>Registered On</td>
                <td><b> <?php $formatted_date = new DateTime($user->created); echo $formatted_date->format('j-M-Y | g:i A'); ?></b></td>
              </tr>

              <tr>
                <td>Status</td>
                <td style="color: #fff; font-size: 14px;">
                    <?php 

                        if($user->isActive == 1){
                            echo "<b style='background: green; border-radius: 3px; padding: 0 5px;'>Active</b>";
                        }else{
                            echo "<b style='background: red; border-radius: 3px; padding: 0 5px;'> Not Active</b>";
                        }

                    ?>
                    <!-- <b> <?php echo $user->bitcoin_address; ?>  -->
                </b></td>
              </tr>

            </tbody>
          </table>
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