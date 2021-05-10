<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Withdrawals";
    $page_name = "withdrawals";

    include_once 'objects/withdrawal.php';
    include_once 'objects/log.php';

    $withdrawal = new Withdrawal($db);    
    $withdrawal->user_id = $user->id;
    $stmt = $withdrawal->readUserWithdrawals();

    if($_POST){

        $withdrawal = new Withdrawal($db);
        if($user->acct_balance >= $_POST['amount']){
            $withdrawal->amount = $_POST['amount'];
            $withdrawal->user_id = $user->id;

            if($withdrawal->create()){

                //update balance
                $user->acct_balance = $user->acct_balance - $withdrawal->amount;
                $user->update();

                //add log
                $log = new Log($db);
                $log->user_id = $user->id;
                $log->action = "$ {$withdrawal->amount} withdrawal request was made.";
                $log->create();


                header("Location: {$home_url}withdrawals.php?action=withdrawal_successful");
            }else{
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Sorry, an error occured.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                        </div>";
            }
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            You do not have sufficient funds to make this withdrawal.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                        </div>";
        }
    }



    // get 'action' value in url parameter to display corresponding prompt messages
   $action=isset($_GET['action']) ? $_GET['action'] : "";

   //tell the user to login
   if($action == "withdrawal_successful"){
          echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Your withdrawal request was successful and your funds are being processed.
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

        <div class="card">
            <div class="card-body scroller">

            <?php 
                if($stmt->rowCount() > 0){
            
            ?>
                <table id="default-table" class="custom-table">
                    <thead>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php 
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);

                                $statusClass = "";
                                switch($status){
                                    case 'pending':
                                        $statusClass = "warning";
                                        break;
                                    case 'approved':
                                        $statusClass = "success";
                                        break;
                                }
                        ?>
                        <tr>
                            <td><span class="badge bg-<?php echo $statusClass; ?> text-light"><?php echo $status; ?></span></td>
                            <td>$<?php echo number_format($amount); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($created)); ?></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>

                <?php }else{ ?>
                <div class="flex justify-between"style="width: 100%;">
                    <img src="static/imgs/empty.png" alt="" class="empty-data-img">
                    <p style="color: var(--text-grey);">No withdrawals yet.</p>
                </div>
                <?php } ?>
            </div>
        </div>
      </section>



    </main>
</section>


<?php 
    include_once 'footer.php';