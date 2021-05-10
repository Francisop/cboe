<?php 
    include_once 'config/core.php';

    //check if user is logged in
    if(!(isset($_SESSION['logged_in'])) && $_SESSION['logged_in'] != true){
        header("Location: {$home_url}login.php?action=please_login");
    }

    include_once 'header.php';

    $page_title = "Referrals";
    $page_name = "referral";
?>


<section class="flex no-ver-align page-parent">
    <?php
        include_once 'nav.php'
    ?>

    <main class="page-body">
      <?php include_once 'layouts/page-heading.php' ?>


      <section class="page-body-container">

      <div class="flex justify-center">
        <div class="card medium-card">
          <div class="card-header">Referral Link</div>
            <div class="card-body">
                <p style="color: var(--text-grey)">Automatically Top up your Balance by Sharing your Referral Link, Earn a percentage of whatever Plan your Referred user Buys.</p>
                <div class="flex justify-between" style="row-gap: 20px;">
                    <input type="text" class="form-control medium" readonly value="https://igbrokers.org/<?php echo $user->username; ?>">
                    <button class="btn btn-primary custom-btn btn-sm" type="button">Copy Link</button>
                </div>
            </div>
        </div>
      </div>

      </section>



    </main>
</section>




<?php 
    include_once 'footer.php';