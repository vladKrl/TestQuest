<?php session_start(); require_once('redirectRegAuth.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Authorization</title>
</head>
<body>
  
    <header>
        <p>AUTHORIZATION</p>
    </header>
    <div class="container">
        <form>
            <p class='msg' id='notValidAuthorizeLogin'></p>
            <label for="user_login"><p>User login</p>
                <input id="userloginAuth" name="userloginAuth" type="text">
            </label>
            <p class='msg' id='notValidAuthorizePassword'></p>
            <label for="user_password"><p>Password</p>
                <input id="passwordAuth" name="passwordAuth" type="password">
            </label>
            <button type="submit" class="buttonAuthorization"><p>Authorize</p></button>
            <p><a href="index.php">Not registered yet?</a></p>
        </form>
    </div>
    <noscript>
        <p>Включите Java-Script в настройках вашего браузера!</p>
    </noscript>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>