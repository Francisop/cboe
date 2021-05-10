<?php

    function update_profit(){
        $database = new Database();
        $db = $database->getConnection();

        $plan = new Plan($db);
        $subscription = new Subscription($db);

        $stmt = $subscription->readAll();

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $plan->name = $name;
                $plan->readOne();

                $current_profit = 0;
                $dateCreated = strtotime($created);
                $dateNow = strtotime(date('Y-m-d H:i:s'));
                $hoursSpent = abs($dateNow - $dateCreated)/(60*60);

                $daysSpent = floor(($hoursSpent/24 > $plan->days_duration) ? $plan->days_duration : $hoursSpent/24);

                if($daysSpent >= 1){
                    $current_profit = $daysSpent*($plan->percent_profit/100)*$deposit;

                    if($status == 0){
                        //update subscription current profit
                        $subscription->id = $id;
                        $subscription->readOne();
                        $subscription->profit = $current_profit;
                        $subscription->update();
                        
                        if($daysSpent == $plan->days_duration){

                            //update user balance
                            $user = new User($db);
                            $user->id = $user_id;
                            $user->readOne();
                            $user->acct_balance = $user->acct_balance + $current_profit;
                            $user->update();
                            //update subscription status if duration expired
                            $subscription->status = 1;
                            $subscription->update();
                        }

                        
                    }
                    
                }
            }
        }
    }


    function get_total_profit($user_id){
        $database = new Database();
        $db = $database->getConnection();

        $subscription = new Subscription($db);
        $subscription->user_id = $user_id;
        $stmt = $subscription->readUserSubscriptions();

        $total_profit = 0;

        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $total_profit = $total_profit + $profit;
            }
        }

        return $total_profit;
    }

?>