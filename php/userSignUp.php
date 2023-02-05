<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    
    require_once('../model/JSON.php');
    require_once('../model/User.php');

    $userlogin = $_POST['userlogin'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $email = $_POST['email'];
    $name = $_POST['username'];
    
    $us = new User($userlogin, $password, $confirmpassword, $email, $name);
    
    unset($us);

}
else {
    header('Location: index.php');
}

