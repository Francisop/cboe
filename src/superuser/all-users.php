<?php
    include_once '../config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] != true){
    header("Location: {$home_url}superuser/index.php?action=please_login");
    }

    // include classes
    include_once '../config/database.php';
    include_once '../objects/user.php';
    include_once '../objects/plan.php';
    include_once '../objects/subscription.php';

    $page_name = "all-users";

    //update all user profit
    include_once '../update-profit.php';
    update_profit();

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    
    // prepare objects
    $user = new User($db);
    $subscription = new Subscription($db);

    $stmt = $user->readAll();

    @include_once './header.php';

?> 



    <div class="container mt-5">

       <?php @include_once './admin-nav.php'; ?>

        <div class="card mt-5">
            <div class="card-header">ALL USERS</div>
            <div class="card-body scroller">
                <table id="default-table" class="custom-table">
                    <thead>
                        <th>Username</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>

                    <tbody>

                        <?php // loop through the transfer records
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row); 

                        ?>

                        <tr>
                            <td> <?php echo $username; ?> </td>
                            <td>$ <?php echo $acct_balance; ?> </td>
                            <td style="color: #fff; font-size: 14px;">
                                <?php 

                                    if($isActive == 1){
                                        echo "<b style='background: green; border-radius: 3px; padding: 0 5px;'>Active</b>";
                                    }else{
                                        echo "<b style='background: red; border-radius: 3px; padding: 0 5px;'> Not Active</b>";
                                    }

                                ?>
                            </td>
                            <td>
                                <a href="user-details.php?id=<?php echo $id; ?>"><span class="btn btn-success btn-sm">More</span></a>
                                <a href="user-edit.php?id=<?php echo $id; ?>"><span class="btn btn-primary btn-sm">Edit</span></a>
                            </td>
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