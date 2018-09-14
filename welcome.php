<?php

include_once('class.User.php');

// Kollar om SESSION variabeln har ett värde. (Så att man inte kan skriva welcome.php i adressfältet och lyckas)
if ($_SESSION == NULL) {
    header("Location: http://localhost/lab2/index.php", true, 301);
    exit();
}
if (isset($_POST['submitLogout'])) {
    $logoutData = $_POST;
    $user = new User();
    $user->userLogout($logoutData);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
    <form action="welcome.php" method="POST">
        <input type="submit" name="submitLogout" value="Log out">
    </form>
</body>
</html>