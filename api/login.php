<?php
include('./base.php');
$user = $Admin->find(['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);

if(!empty($user)){

    $_SESSION['user'] = $_POST['acc'];
    to('../back.php');

}else{

    alert('帳號或密碼輸入錯誤');
    header("refresh:0,url='../index.php?do=login'");

}



?>