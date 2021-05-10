<?php
    include_once 'config/core.php';


    // include classes
    include_once 'config/database.php';
    include_once 'objects/withdrawal.php'; 

    // get acess
    $get_access = isset($_GET['access']) ? $_GET['access'] : die('ERROR: missing access.');

    if($_POST){

        // get database connection
        $database = new Database();
        $db = $database->getConnection();
        
        // prepare objects
        $withdrawal = new Withdrawal($db);

        // get acess
        $get_access = isset($_GET['access']) ? $_GET['access'] : die('ERROR: missing access.');

        
        // set user ID property
        $withdrawal->id = $get_access;

        $withdrawal->readOne();

        if($withdrawal->access_code == ""){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Transaction Error. Please contact your broker manager.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
        }else if($withdrawal->access_code == $_POST["code"]){

            $withdrawal->status = "approved";
            $withdrawal->changeStatus();
            header("Location: {$home_url}transaction_done.php");

        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Invalid IMT Code.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
        }
    }
 
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Transaction</title>
  
      <!-- CSS only -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
      <link href="static/css/index.css" rel="stylesheet">
  
      <!-- JavaScript -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  </head>
  <body>
      
  
      <a href="./" class="auth-page logo flex justify-center" style="margin-top: 50px;">
        <svg width="102" height="74" viewBox="0 0 102 74" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M27.9 8L20.1 10.3V63.7L27.9 65.8V72H2.83122e-07V65.8L7.8 63.8V10.4L2.83122e-07 8.49999V2.3L27.9 1.8V8ZM69.2375 73.1C62.7042 73.1 56.9708 71.7667 52.0375 69.1C47.1708 66.3667 43.4042 62.3667 40.7375 57.1C38.0708 51.7667 36.7375 45.2 36.7375 37.4C36.7375 29.6667 38.0708 23.0667 40.7375 17.6C43.4708 12.1333 47.3375 7.96666 52.3375 5.1C57.4042 2.16666 63.4375 0.699994 70.4375 0.699994C74.2375 0.699994 78.1708 1.13333 82.2375 2C86.3708 2.86666 90.5375 4.16666 94.7375 5.9L93.8375 23.1H86.4375L84.5375 12.5C82.2708 11.7667 80.0042 11.2 77.7375 10.8C75.4708 10.3333 73.3042 10.1 71.2375 10.1C64.5708 10.1 59.3375 12.4333 55.5375 17.1C51.8042 21.7 49.9375 28.4 49.9375 37.2C49.9375 45.5333 51.7042 52.0333 55.2375 56.7C58.8375 61.3 63.9708 63.6 70.6375 63.6C74.4375 63.6 78.5375 62.8333 82.9375 61.3V45.3L75.1375 44V37.6L101.938 37.1V43.6L94.3375 45.4V67.6C89.8042 69.4667 85.4042 70.8667 81.1375 71.8C76.9375 72.6667 72.9708 73.1 69.2375 73.1Z" fill="#002954"/>
        </svg>
      </a>
  
      <form action="complete-transaction.php?access=<?php echo $get_access; ?>" method="post" class="flex justify-center">
          <div class="auth-container ctp">
              <h2>Pending Transfer.</h2>
  
              <p class="mt-3">Almost finished! Please not that IG Brokers may charge a fee for processing your transfer, which is 
                  not to be deducted from this account.
              </p>

              <p>Please contact your broker manager to obtain your IMT code.</p>
  
              <p>Enter International Money Transfer Code to complete the transaction.</p>
  
              <div class="mt-5">
                  <label class="col-form-label">IMT CODE</label>
                  <input type="tel" name="code" class="form-control">
              </div>
  
              <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary custom-btn">Confirm Transaction</button>
              </div>
          </div>
      </form>
  
  
  </body>
  </html>