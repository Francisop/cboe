

        <!-- Witdrawal Modal -->
        <div class="modal fade" id="withdrawal-modal" tabindex="-1" aria-labelledby="withdrawal-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Withdraw Funds</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="withdrawals.php" method="post">
                        <div class="modal-body">
                            <div class="flex justify-between mt-3 mb-3">
                                <label class="col-form-label">Amount($)</label>
                                <input type="number" name="amount" class="form-control medium">
                            </div>
                        </div>
                        <div class="modal-footer flex justify-center">
                            <button type="submit" class="btn btn-primary custom-btn">Proceed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Plan subscription Modal -->
        <div class="modal fade" id="plan-subscription-modal" tabindex="-1" aria-labelledby="plan-subscription-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plan Subscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="plans.php" method="post">
                    <div class="modal-body">
                        <div class="flex justify-between mt-3 mb-3">
                            <label class="col-form-label">Deposit Amount($)</label>
                            <input type="number" name="amount" class="form-control medium">
                        </div>
                        <input type="hidden" name="plan_name" id="selected-subcription-plan">
                    </div>
                    <div class="modal-footer flex justify-center">
                        <button type="submit" class="btn btn-primary custom-btn">Proceed</button>
                    </div>
                </form>

                </div>
            </div>
        </div>

        <!-- Logout Modal -->
        <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer flex justify-center">
                    <a href="./logout.php"><button type="button" class="btn btn-light">Yes</button></a>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Keep me in!</button>
                </div>
                </div>
            </div>
        </div>








    
        <div class="footer flex justify-center">
            <div class="flex text-center footer-container">
                <span><a href="">privacy policy</a></span>
                <span><a href="">terms & conditions</a></span>
                <span>&copy; <?php echo date("Y");?> IG Brokers </span>
            </div>
        </div>

    <script src="static/js/index.js"></script>



</body>
</html>