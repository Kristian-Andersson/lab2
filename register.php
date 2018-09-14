<?php

include_once('class.User.php');
// Kör en array pop, vilket tar bort det sista värdet i arrayen som i detta fall är submit, (vi vill bara ha med username/password)
if (isset($_POST['submitRegister'])) {
    array_pop($_POST);
    $postData = $_POST;
    $user = new User();
    $user->userRegister($postData);
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Register account</h1>
    <form action="register.php" method="POST">
        <label for="username">Username</label><br>
        <input type="text" name="username"><br><br>
        <label for="userPassword">Password</label><br>
        <input type="password" name="userPassword"><br><br>
        <input name="submitRegister" type="submit" value="Create account">
    </form>
</body>
</html>