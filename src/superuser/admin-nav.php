

<?php 

    function active_class($page_name, $link_page_name){
        if($page_name == $link_page_name){
            echo "active";
        }else{
            echo "";
        }
    }


?>

        <style>
            .admin-link{
                font-size: 20px;
                font-weight: bold;
                padding: 10px;
                border-radius: 5px;
            }

            .admin-link a{
                color: var(--text-grey);
                text-decoration: none;
            }

            .admin-link a:hover{
                color: var(--main-color1);
            }

            .admin-link.active a{
                color: var(--main-color1);
                text-decoration: underline;
            }
        </style>


        <div class="flex justify-between">
            <h2 class="admin-link <?php echo active_class($page_name, "all-users"); ?>"><a href="./all-users.php">All Users</a></h2>
            <h2 class="admin-link <?php echo active_class($page_name, "withdrawals"); ?>"><a href="./withdrawals.php">Withdrawals</a></h2>
            <h2 class="admin-link <?php echo active_class($page_name, "investments"); ?>"><a href="./subscriptions.php">Investments</a></h2>
            <div><a href="logout.php"><span class="btn btn-danger btn-sm">Logout</span></a></div>
        </div>