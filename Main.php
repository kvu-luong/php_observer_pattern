<?php

include "./ConcreteSubject.php";
include "./Logger.php";
include "./Mailer.php";
include "./Security.php";

$account = new Account();
//Attach các observer vào subject
$account->attach(new Logger());
$account->attach(new Mailer());
$security = new Security();
$account->attach($security);

//Đăng nhập
$account->login('access@gmail.com', '123.123.12.3');
//Thay đổi state
$account->setState(Account::EXPIRED);
$account->save();
$account->login('test@gmail.com', '10.0.0.1');
//Xóa security observer
$account->detach($security);
$account->login('test@gmail.com', '10.0.0.1');

?>