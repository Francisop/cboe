<?php
    include_once '../config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] != true){
    header("Location: {$home_url}superuser/index.php?action=please_login");
    }

    // include classes
    include_once '../config/database.php';
    include_once '../objects/user.php';
    include_once '../objects/subscription.php';

    $page_name = "investments";

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare objects
    $subscription = new Subscription($db);
    $user = new User($db);

    $stmt = $subscription->readAll();

    @include_once './header.php';

?> 



<div class="container mt-5">

   <?php @include_once './admin-nav.php'; ?>

    <div class="card mt-5">
        <div class="card-header">INVESTMENTS</div>
        <div class="card-body scroller">
            <table id="default-table" class="custom-table">
                <thead>
                    <th>Status</th>
                    <th>Deposit</th>
                    <th>Current Profit</th>
                    <th>Plan</th>
                    <th>User</th>
                    <th>Date</th>
                </thead>

                <tbody>

                    <?php // loop through the transfer records
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);

                            $user->id = $user_id;
                            $user->readOne();

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
                        <td> $<?php echo number_format($deposit); ?> </td>
                        <td> $<?php echo number_format($profit); ?> </td>
                        <td><?php echo $name; ?> </td>
                        <td><?php echo $user->username;; ?> </td>
                        <td> <?php echo date('Y-m-d H:i:s', strtotime($created)); ?> </td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    
</div>

<script>
    $(document).ready(function(){
        //Data tables
        $('#default-table').DataTable({
            "pageLength": 7,
            "lengthMenu": [ 7, 10, 25, 50, 75, 100 ],
            "ordering": false,
        });

        $('.just-table').DataTable({
            searching: false,
            paging: false,
            "ordering": false,
        });
    })
</script>

</body>
</html>