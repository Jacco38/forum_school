<?php
include_once 'app/templates/bovenstuk.php';
?>
<title>JKForum - Login</title>
</head>
<!DOCTYPE html>
<html lang="en">
<div class="jumbotron">
    <h2>Login</h2><hr>
    <?php

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
        unset($_SESSION['error']);
    }

    ?>
    <form action="app/login_handler.php" method="POST">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <input type="submit" class="btn btn-primary"><br><br>
        <a href="forgotpass.php">Forgot password</a>
    </form>
</div>
</body>
</html>