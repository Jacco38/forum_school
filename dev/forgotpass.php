<?php
include_once 'app/templates/bovenstuk.php';
?>
<title>JKForum - Forgot password</title>
</head>
<!DOCTYPE html>
<html lang="en">
<div class="jumbotron">
    <h2>Forgot password</h2><hr>
    <?php

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
        unset($_SESSION['error']);
    }

    ?>
    <form action="app/forgotpass_handler.php" method="POST">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <input type="submit" class="btn btn-primary">
    </form>
</div>
</body>
</html>