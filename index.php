<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School DB Manager</title>
</head>
<body>
    <form action="login.php" method="POST">
        Login: <br>
        <input type="text" name="login"> <br>
        Password: <br>
        <input type="password" name="password"> <br>
        <input type="submit" value="Login">
    </form>

    <div id="errors" style="color:red;">
    <?php
    if (isset($_SESSION["errors"])) {
        echo $_SESSION["errors"];
        unset($_SESSION["errors"]);
    }
    ?>
    </div>
</body>
</html>