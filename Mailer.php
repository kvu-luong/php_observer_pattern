<?php 

class Mailer implements Observer{
    public function update(Account $account){
        $state = $account->getState();
        $data = $account->getData();
        if($state == Account::EXPIRED){
            // Email::send($email, "Account hết hạn rồi bạn ei");
            echo "Account {$data['email']} has expired. Email sent!\n";
        }
    }
}