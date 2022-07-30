<?php
date_default_timezone_set('Asia/Taipei');
session_start();

function to($url){
    header("location:$url");
}


?>