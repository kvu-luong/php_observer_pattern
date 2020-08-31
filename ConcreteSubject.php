<?php
include './Subject.php';
class Account implements Subject{

    const LOGIN_SUCCESS = 1;
    const LOGIN_FAILURE = 2;
    const LOGIN_INVALID = 3;
    const EXPIRED = 4;

    private $state;
    private $storage;

    private $data;

    public function __construct(){
        $this->storage = array();
        $this->data = array();
    }

    //Attach 1 Observer
    public function attach(Observer $observer){
        $isContain = array_search($observer, $this->storage);
        if($isContain === false){
            $this->storage[] = $observer;
        }
    }

    //Xóa 1 Observer ra khỏi danh sách
    public function detach(Observer $observer){
        foreach($this->storage as $key => $val){
            if($val == $observer){
                unset($this->storage[$key]);
            }
        }
    }

    //Gửi thông báo update tới tất cả các observers trong hệ thống
    public function notify(){
        foreach($this->storage as $observer){
            $observer->update($this);
        }
    }

    public function login($email, $ip){
        $this->setData([
            'email'=> $email,
            'ip'=> $ip
        ]);
        if($email == 'test@gmail.com' && $ip == '10.0.0.1'){
            $this->setState(Account::LOGIN_INVALID);
        }else{
            $login = $this->process($email);
            if($login){
                $this->setState(Account::LOGIN_SUCCESS);
            }else{
                $this->setState(Account::LOGIN_FAILURE);
            }
        }

        $this->notify();
    }

    public function save(){
        $this->notify();
    }

    public function setState($state){
        $this->state = $state;
    }

    public function getState(){
        return $this->state;
    }
    //is correct mail 
    public function process($email){
        if($email == 'access@gmail.com'){
            return true;
        }
        return false;
    }
    
    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }
}