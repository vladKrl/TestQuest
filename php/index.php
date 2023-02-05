<?php session_start(); require_once('redirectRegAuth.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>REGISTRATION</title>
</head>
<body>
    <header>
        <p>REGISTRATION</p>
    </header>
    <div class="container">
 
        <form>
            
            <p class='msg' id='notValidUserlogin'></p>
            <label for="user_login"><p>User login</p>
                <input id="userlogin" name="userlogin" type="text">
            </label>
            
            <p class='msg' id='notValidPassword'></p>
            <label for="user_password"><p>Password</p>
                <input id="password" name="password" type="password">
            </label>
            
            <p class='msg' id='notCorrectPasswords'></p>
            <label for="confirm_password"><p>Confirm password</p>
                <input id="confirmpassword" name="confirmpassword" type="password">
            </label>
            
            <p class='msg' id='notValidEmail'></p>
            <label for="user_email"><p>E-mail</p>
                <input id="email" name="email" type="email">
            </label>
            
            <p class='msg' id='notValidName'></p>
            <label for="user_name"><p>Name</p>
                <input id="username" name="username" type="text">
            </label>
            <button type="submit" class="buttonRegistration"><p>Register</p></button>
            <p><a href= "authorization.php">Already registered?</a></p>
        </form>
    </div>
    <noscript>
        <p>Включите Java-Script в настройках вашего браузера!</p>
    </noscript>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>