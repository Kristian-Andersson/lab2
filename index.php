<?php

session_start();

include_once('class.User.php');

// Kollar om användaren har klickat på submit sedan lägger jag $_POST variabeln i en icke reserverad variabel
// Skapar ett nytt objekt och skickar sedan in den nya $_POST variabeln in till userLogin funktionen 
if (isset($_POST['submitLogin'])) {
    $loginData = $_POST;
    $user = new User();
    $user->userLogin($loginData);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Login</h1>
    <form action="index.php" method="POST">
        <label for="username">Username</label><br>
        <input type="text" name="username"><br><br>
        <label for="userPassword">Password</label><br>
        <input type="password" name="userPassword"><br><br>
        <input name="submitLogin" type="submit" value="Login">
    </form>
    <p>Don't have an account? Register <a href="http://localhost/lab2/register.php">here!</a></p>
</body>
</html>