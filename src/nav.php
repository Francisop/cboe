<?php

    $nav_active_class = "";

    function active_class($page_name, $link_page_name){
        if($page_name == $link_page_name){
            echo "active";
        }else{
            echo "";
        }
    }

?>

<div class="nav-container scroller">
    <div class="logo flex justify-center">
        <img src="static/imgs/logo.png" alt="logo">
    </div>

    <div class="links-group">
        <a href="./" class="flex link-box <?php active_class($page_name, "dashboard")?>">
            <i class="bi bi-intersect"></i>
            <span>Dashboard</span>
        </a>

        <a href="https://binance.com/en/buy-sell-crypto?fiat=USD&crypto=BTC" class="flex link-box">
            <i class="bi bi-plus-circle"></i>
            <span>Fund Account</span>
        </a>

        <a href="investments.php" class="flex link-box">
            <i class="bi bi-cash-stack"></i>
            <span>Investments</span>
        </a>

        <a href="withdrawals.php" class="flex link-box <?php active_class($page_name, "withdrawals")?>">
            <i class="bi bi-wallet-fill"></i>
            <span>Withdrawals</span>
        </a>

        <a href="plans.php" class="flex link-box <?php active_class($page_name, "plans")?>">
            <i class="bi bi-clipboard-data"></i>
            <span>Subscription Plans</span>
        </a>

        <a href="https://cex.io" class="flex link-box">
            <i class="bi bi-shuffle"></i>
            <span>Exchange</span>
        </a>

        <a href="settings.php" class="flex link-box <?php active_class($page_name, "settings")?>">
            <i class="bi bi-gear-wide-connected"></i>
            <span>Settings</span>
        </a>

        <a href="audit-logs.php" class="flex link-box <?php active_class($page_name, "audit-logs")?>">
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Audit Logs</span>
        </a>

        <a href="referral.php" class="flex link-box <?php active_class($page_name, "referral")?>">
            <i class="bi bi-gift"></i>
            <span>Referrals</span>
        </a>
    </div>

    <div class="close-nav">
        <i class="bi bi-x"></i>
    </div>
</div>