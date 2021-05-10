<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Audit Logs";
    $page_name = "audit-logs";

    include_once 'objects/log.php';

    $log = new Log($db);
    $log->user_id = $user->id;
    $stmt = $log->readUserLogs();

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
                <table id="default-table" class="custom-table">
                    <thead>
                        <th>Log ID</th>
                        <th>Action</th>
                        <th>Date</th>
                    </thead>

                    <tbody>
                        <?php 
                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);
                        ?>
                        <tr>
                            <td><?php echo $log_id; ?></td>
                            <td><?php echo $action; ?></td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($created)); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

      </section>



    </main>
</section>




<?php 
    include_once 'footer.php';