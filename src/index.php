<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
      header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Hi, {$user->firstname}";
    $page_name = "dashboard";

    include_once 'objects/plan.php';
    include_once 'objects/subscription.php';

    $plan = new Plan($db);
    $subscription = new Subscription($db);
    $subscription->user_id = $_SESSION['user_id'];
    $stmt = $subscription->readUserSubscriptions();


    // get 'action' value in url parameter to display corresponding prompt messages
    $action=isset($_GET['action']) ? $_GET['action'] : "";

    //tell the user to login
    if($action == "subscription_created"){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                     Your subscription plan was created successfully.
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
        <div class="flex justify-between no-ver-align grid-2-page">


          <!-- LEFT SECTION -->
          <section>

            <div class="card medium-card">
              <div class="card-header">RECENT INVESTMENTS</div>

              <div class="flex justify-between card-body subcr-container">

                <?php

                  if($stmt->rowCount() > 0){

                    $no_active_investment = false;

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                      extract($row);
                      $plan->name = $name;
                      $plan->readOne();

                      $profitProgress = 0;
                      $highestProfit = $deposit * ($plan->percent_profit/100) * $plan->days_duration;

                      $dateCreated = strtotime($created);
                      $dateNow = strtotime(date('Y-m-d H:i:s'));
                      $hoursSpent = abs($dateNow - $dateCreated)/(60*60);

                      $daysSpent = floor(($hoursSpent/24 > $plan->days_duration) ? $plan->days_duration : $hoursSpent/24);

                      if($status == 1){
                        $no_active_investment = true;
                        continue;
                      }else{
                        $no_active_investment = false;
                      }
                      
                      $profitProgress = ($profit/$highestProfit)*100;
                        
                ?>

                <div class="subcr-active" style="background: var(--card-<?php echo $name; ?>-light);">
                  <div style="width: 100%; text-align: right">
                    <span class="name" style="background: var(--card-<?php echo $name; ?>);"><?php echo $name; ?> Pack</span>
                  </div>

                  <div class="flex justify-between mt-2">
                    <div class="classify">
                      <span>deposit</span>
                      <h2>$<?php echo number_format($deposit); ?></h2>
                    </div>

                    <div class="classify">
                      <span>profit</span>
                      <h2><?php echo $plan->percent_profit; ?>%</h2>
                    </div>
                  </div>

                  <div class="classify mt-2">
                    <span>duration - <?php echo $plan->days_duration;  ?> days</span>
                    <h2>$<?php echo number_format($profit); ?>/$<?php echo number_format($highestProfit); ?></h2>
                  </div>

                  <div class="progress-bar">
                    <div class="inner" style="background: var(--card-<?php echo $name; ?>); width: <?php echo $profitProgress; ?>%;"></div>
                  </div>
                </div>

                <?php }

                      if($no_active_investment){
                        echo "You have no active investments.";
                      }
                  
                  }else{
                ?>

                  <div class="flex justify-between"style="width: 100%;">
                    <img src="static/imgs/empty.png" alt="" class="empty-data-img">
                    <p style="color: var(--text-grey);">You have not made any investments yet.</p>
                    <a href="plans.php" class="btn btn-primary custom-btn btn-sm">Start Investing</a>
                  </div>

                <?php }?>

              </div>
            </div>


            <div class="card medium-card mt-5">
              <div class="card-header">CRYPTO LIVE CALCULATOR</div>
              <div class="card-body">
                <script src="https://cdn.jsdelivr.net/gh/coinponent/coinponent@1.2.6/dist/coinponent.js"></script>
                <coin-ponent shadow="none"></coin-ponent>
              </div>
            </div>

            <div class="card medium-card mt-5 hide-mobile">
              <div class="card-body">
                <script type="text/javascript">
                  baseUrl = "https://widgets.cryptocompare.com/";
                  var scripts = document.getElementsByTagName("script");
                  var embedder = scripts[ scripts.length - 1 ];
                  var cccTheme = {"General":{"borderWidth":"0","borderColor":"#fff"}};
                  (function (){
                  var appName = encodeURIComponent(window.location.hostname);
                  if(appName==""){appName="local";}
                  var s = document.createElement("script");
                  s.type = "text/javascript";
                  s.async = true;
                  var theUrl = baseUrl+'serve/v1/coin/histo_week?fsym=BTC&tsym=USD';
                  s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                  embedder.parentNode.appendChild(s);
                  })();
                </script>

              </div>
            </div>

          </section>


          <!-- RIGHT SECTION -->
          <section>

            <div class="card small-card">
              <div class="card-header">PAYOUTS</div>
              <div class="card-body">

                  <div class="flex justify-between">
                    <div class="classify large">
                      <span>Total Earned Profits</span>
                      <h2>$<?php echo number_format(get_total_profit($user->id)); ?></h2>
                    </div>

                    <div class="classify large">
                      <span>Referral Bonuses</span>
                      <h2>$<?php echo number_format($user->referral_bonus); ?></h2>
                    </div>
                  </div>
              </div>
          
            </div>



            <div class="card small-card mt-5">
              <div class="card-header">LIVE CRYPTO PRICES</div>
              <div class="card-body">
                <script type="text/javascript">
                  baseUrl = "https://widgets.cryptocompare.com/";
                  var scripts = document.getElementsByTagName("script");
                  var embedder = scripts[ scripts.length - 1 ];
                  var cccTheme = {"Currency":{"color":"#002051"},"Trend":{"colorDown":"#FF0000"},"Menu":{"triggerBackgroundHover":"#4c6285","linkHoverBackground":"#4c6285"}};
                  (function (){
                    var appName = encodeURIComponent(window.location.hostname);
                    if(appName==""){appName="local";}
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    var theUrl = baseUrl+'serve/v2/coin/header?fsyms=BTC,ETH,XMR,LTC&tsyms=USD,EUR,CNY,GBP';
                    s.src = theUrl + ( theUrl.indexOf("?") >= 0 ? "&" : "?") + "app=" + appName;
                    embedder.parentNode.appendChild(s);
                  })();
                </script>

              </div>
            </div>


            <div class="card small-card mt-5">
              <div class="card-header">CRYPTO CHARTS</div>
              <div class="card-body">

                <iframe scrolling="no" sandbox="allow-same-origin allow-scripts allow-top-navigation allow-popups" src="https://widget.nomics.com/assets/BTC/USD/" height="270px" width="100%" frameborder="0"></iframe>
                <iframe scrolling="no" sandbox="allow-same-origin allow-scripts allow-top-navigation allow-popups" src="https://widget.nomics.com/assets/BTC/ETH/" height="270px" width="100%" frameborder="0"></iframe>

              </div>
            </div>

          </section>
        </div>

        <div class="mt-5 large-card scroller">
              <iframe src="https://www.widgets.investing.com/crypto-currency-rates?theme=lightTheme&amp;roundedCorners=true&amp;pairs=945629,997650,1001803,1010773,940810,1010776,1010801,1054920" allowtransparency="true" marginwidth="10" marginheight="10" width="900" height="400" frameborder="0"></iframe>
        </div>
      </section>
      
      
    </main>
</section>




<?php 
    include_once 'footer.php'
?>