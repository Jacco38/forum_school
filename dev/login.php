<?php
session_start();
include_once "app/loggedin_check.php";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include_once "app/templates/menu.php";
?>
<div id="content">
    <?php

    if (isset($_SESSION['error'])) {
        echo '<div class="error"><a>'.$_SESSION['error'].'</a></div>';
        unset($_SESSION['error']);
    }

    ?>
    <div class="reg-form">
        <a>Login</a>
        <form method="POST" action="app/login_handler.php">
            <input id="input" type="email" name="email" placeholder="Email" required><br>
            <input id="input" type="password" name="password" placeholder="Password" required><br>
            <input id="submit" type="submit" value="Login">
        </form>
    </div>
</div>
<footer>

</footer>
</body>

</html>