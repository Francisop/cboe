<?php
    include_once '../config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['superuser_logged_in'])) && $_SESSION['superuser_logged_in'] != true){
    header("Location: {$home_url}superuser/index.php?action=please_login");
    }

    // include classes
    include_once '../config/database.php';
    include_once '../objects/withdrawal.php';
    include_once '../objects/user.php';

    $page_name = "withdrawals";

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare objects
    $withdrawal = new Withdrawal($db);
    $user = new User($db);

    $stmt = $withdrawal->readAll();

    @include_once './header.php';

    // get 'action' value in url parameter to display corresponding prompt messages
   $action=isset($_GET['action']) ? $_GET['action'] : "";

   //tell the user to login
   if($action == "code_generate_error"){
          echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
                    Cannot generate code. Please try again.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
    }

    ?>      

    <div class="container mt-5">


        <?php @include_once './admin-nav.php'; ?>


        <div class="card mt-5">
            <div class="card-header">WITHDRAWALS</div>
            <div class="card-body scroller">
                <table id="default-table" class="custom-table">
                    <thead>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>IMT Access Code</th>
                        <th>Verification Link</th>
                        <th>Date</th>
                    </thead>

                    <tbody>

                        <?php // loop through the transfer records
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row);

                                $user->id = $user_id;
                                $user->readOne();

                        ?>

                        <tr>
                            <td> <?php echo $user->username; ?> </td>
                            <td>$ <?php echo number_format($amount); ?> </td>
                            <td>
                                <?php 

                                    if($status == "pending"){
                                        echo "<span class='badge bg-warning text-light'>{$status}</span>";
                                    }else{
                                        echo "<span class='badge bg-success text-light'>{$status}</span>";
                                    }

                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($access_code == ""){
                                ?>
                                <a href="./generate-code.php?id=<?php echo $id; ?>"><span class='badge bg-primary'>generate code</span></a>
                                <?php }else{ echo $access_code;} ?>
                            </td>
                            <td> 
                                <div class="verification-link"><?php echo $home_url; ?>complete-transaction.php?access=<?php echo $id ?></div>
                            </td>
                            <td><?php echo date('Y-m-d H:i:s', strtotime($created)); ?></td>
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