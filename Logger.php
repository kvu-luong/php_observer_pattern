<?php
include "./Observer.php";
class Logger implements Observer{
    public function update(Account $account){
        $state = $account->getState();
        $data = $account->getData();
        if($state == Account::LOGIN_SUCCESS){
            //thực hiện log thời gian user online 
            echo "user {$data['email']} vừa online\n";
        }
    }
}