<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Subscription Plans";
    $page_name = "plans";

    include_once "objects/plan.php";
    include_once "objects/subscription.php";
    include_once "objects/log.php";

    if($_POST){
        $plan = new Plan($db);
        $subscription = new Subscription($db);

        $plan->name = $_POST['plan_name'];
        $plan->readOne();

        $validateDeposit = $plan->validateDeposit($_POST['amount']);

        if($user->acct_balance >= $_POST['amount']){
            if($validateDeposit){
                $subscription->deposit = $_POST['amount'];
                $subscription->user_id = $_SESSION['user_id'];
                $subscription->name = $_POST['plan_name'];
    
                if($subscription->create()){
                    // update balance
                    $user->acct_balance = $user->acct_balance - $subscription->deposit;
                    $user->update();

                    //add log
                    $log = new Log($db);
                    $log->user_id = $user->id;
                    $log->action = "$ {$subscription->deposit} was invested into the {$subscription->name} plan.";
                    $log->create();
                    
                    header("Location: {$home_url}?action=subscription_created");
                }else{
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Sorry, an error occured.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                        </div>";
                }
            }else{
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        Sorry, your deposit amount is out of range for this plan.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                    </div>";
            }
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Sorry, you do not have sufficient funds to subscribe for this plan.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                </div>";
        }
        
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
            <div class="card-body">
            Payouts wont be available till end of plan duration. Interest means profit and compound is sum of money invested plus profit. Trading bonus is a certain percent of your compound interest. If interest reads minus, dont invest, you will lose money
            </div>
        </div>

        <div class="flex justify-center">

            <div class="flex subscription-container">
                <div class="subscription-box text-center">
                    <span class="name">starter</span>
                    <h2 class="price">$100 - $1,000</h2>

                    <div class="details">
                        <span>400% daily profit</span>
                        <span>5 days profit duration</span>
                        <span>$1,000 maximum investment</span>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary custom-btn plan-subscr-btn" data-plan-name="starter" type="button" data-bs-toggle="modal" data-bs-target="#plan-subscription-modal">Subscribe</button>
                    </div>
                </div>

                <div class="subscription-box text-center">
                    <span class="name">premium</span>
                    <h2 class="price">$1,500 - $5,000</h2>

                    <div class="details">
                        <span>500% daily profit</span>
                        <span>8 days profit duration</span>
                        <span>$5,000 maximum investment</span>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary custom-btn plan-subscr-btn" type="button" data-plan-name="premium" data-bs-toggle="modal" data-bs-target="#plan-subscription-modal">Subscribe</button>
                    </div>
                </div>
            </div>

        </div>


        <div class="flex justify-center">

            <div class="flex subscription-container">
                <div class="subscription-box text-center">
                    <span class="name">gold</span>
                    <h2 class="price">$5,500 - $17,500</h2>

                    <div class="details">
                        <span>700% daily profit</span>
                        <span>15 days profit duration</span>
                        <span>$17,500 maximum investment</span>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary custom-btn plan-subscr-btn" type="button" data-plan-name="gold" data-bs-toggle="modal" data-bs-target="#plan-subscription-modal">Subscribe</button>
                    </div>
                </div>

                <div class="subscription-box text-center">
                    <span class="name">diamond</span>
                    <h2 class="price">$20,000 - $45,000</h2>

                    <div class="details">
                        <span>1000% daily profit</span>
                        <span>30 days profit duration</span>
                        <span>$45,000 maximum investment</span>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-primary custom-btn plan-subscr-btn" type="button" data-plan-name="diamond" data-bs-toggle="modal" data-bs-target="#plan-subscription-modal">Subscribe</button>
                    </div>
                </div>
            </div>

        </div>
      </section>



    </main>
</section>




<?php 
    include_once 'footer.php';