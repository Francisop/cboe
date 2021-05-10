


<div class="crypto-heading">
    <iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&amp;theme=light&amp;pref_coin_id=1505&amp;invert_hover=no" 
    scrolling="auto" marginwidth="0" marginheight="0" border="0" style="border:0;margin:0;padding:0;" width="100%" height="36px" frameborder="0"></iframe>
    <div class="text">
        <span>Live Cryptocurrency Prices by IG</span>
    </div>
</div>


<div class="flex justify-between page-heading">
  <div class="flex hamburger-container">
    <div class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <span class="title"> <?php echo $page_title ?> </span>
  </div>

  <div class="flex details">
    <span class="balance">Bal : <b>$<?php echo number_format($user->acct_balance) ?> </b></span>
    <button class="btn btn-primary custom-btn" type="button" data-bs-toggle="modal" data-bs-target="#withdrawal-modal" >Withdraw</button>
    <div class="logout" data-bs-toggle="modal" data-bs-target="#logout-modal">
      <i class="bi bi-power"></i>
    </div>
  </div>
</div>