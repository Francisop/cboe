<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Investments";
    $page_name = "investments";

    
    $subscription = new subscription($db);    
    $subscription->user_id = $user->id;
    $stmt = $subscription->readUserSubscriptions();
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
                        <th>Deposit</th>
                        <th>Profit</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php 
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);

                                $statusClass = "";
                                switch($status){
                                    case 0:
                                        $statusClass = "primary";
                                        $statusText = "running";
                                        break;
                                    case 1:
                                        $statusClass = "success";
                                        $statusText = "completed";
                                        break;
                                }
                        ?>
                        <tr>
                            <td><span class="badge bg-<?php echo $statusClass; ?> text-light"><?php echo $statusText; ?></span></td>
                            <td>$<?php echo number_format($deposit); ?></td>
                            <td>$<?php echo number_format($profit); ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($created)); ?></td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>

                <?php }else{ ?>
                <div class="flex justify-between"style="width: 100%;">
                    <img src="static/imgs/empty.png" alt="" class="empty-data-img">
                    <p style="color: var(--text-grey);">No investments yet.</p>
                    <a href="plans.php" class="btn btn-primary custom-btn btn-sm">Start Investing</a>
                </div>
                <?php } ?>
            </div>
        </div>
      </section>



    </main>
</section>


<?php 
    include_once 'footer.php';