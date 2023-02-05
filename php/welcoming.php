<?php session_start(); require_once('../model/User.php'); require_once('redirectWelcome.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Welcome!</title>
</head>
<body>
    <header></header>
    <div class="container">
        <form>
            <p>Hello <?= User::writeWelcomingMessage('Name') ?></p>
            <button class="buttonLogOut" type='submit'><p>Exit</p></button>
        </form>
    </div>
    <noscript>
        <p>Включите Java-Script в настройках вашего браузера!</p>
    </noscript>
    <script src="../js/jquery-3.6.3.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>