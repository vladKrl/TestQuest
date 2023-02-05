<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    
    require_once('../model/JSON.php');
    require_once('../model/User.php');
    
    $userlogin = $_POST['userlogin'];
    $password = $_POST['password'];    

    User::userAuthorization($userlogin, $password);

}
else {
    header('Location: authorization.php');
}


