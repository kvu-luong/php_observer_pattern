<?php
class Security implements Observer{
    public function update(Account $account){
        $state = $account->getState();
        $data = $account->getData();
        if($state == Account::LOGIN_INVALID){
            //Block ip
            echo "Account {$data['email']} with ip {$data['ip']} are trying to hack your system!\n";
        }
    }
}