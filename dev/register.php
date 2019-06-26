<?php
include_once 'app/templates/bovenstuk.php';
?>
<title>JKForum - Register</title>
</head>
<div class="jumbotron">
    <h2>Register</h2><hr>
    <?php
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="app/register_handler.php" method="POST">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="pwd">Confirm password:</label>
            <input type="password" class="form-control" name="confirm">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>