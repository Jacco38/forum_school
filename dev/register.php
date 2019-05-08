<?php
session_start();
include_once "app/loggedin_check.php";
?>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Register</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include_once "app/templates/menu.php";
?>
<div id="menu">
    <p>hallo</p>
</div>
<div id="content">
    <?php

        if (isset($_SESSION['error'])) {
            echo '<div class="error"><a>'.$_SESSION['error'].'</a></div>';
            unset($_SESSION['error']);
        }

    ?>
    <div class="reg-form">
        <a>Register</a>
        <form method="POST" action="app/register_handler.php">
            <input id="input" type="email" name="email" placeholder="Email" required><br>
            <input id="input" type="text" name="username" placeholder="Username" required><br>
            <input id="input" type="password" name="password" placeholder="Password" required><br>
            <input id="input" type="password" name="confirm" placeholder="Confirm password" required><br>
            <input id="submit" type="submit" value="Register">
        </form>
    </div>
</div>
<footer>

</footer>
</body>

</html>