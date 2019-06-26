<?php
include_once 'app/templates/bovenstuk.php';
include_once 'app/db/connection.php';

$email = $_GET['email'];
$newpasscode = $_GET['code'];

if (!isset($email) || !isset($newpasscode) || $newpasscode == 0) {
    header("Location: index.php");
    exit(0);
}

$db_sql_statement = $db_connection->prepare("SELECT * FROM users WHERE email = :email");
$db_sql_statement->execute([
    ':email' => $email
]);

$rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $code = $row['newpasscode'];
    if ($newpasscode != $code) {
        $_SESSION['error'] = 'This code is not correct!';
        header("Location: index.php");
        exit(0);
    }
}

?>
<title>JKForum - Reset password</title>
</head>
<!DOCTYPE html>
<html lang="en">
<div class="jumbotron">
    <h2>Reset password</h2><hr>
    <?php

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
        unset($_SESSION['error']);
    }

    ?>
    <form action="app/resetpass_handler.php?email=<?=$email?>&code=<?=$newpasscode?>" method="POST">
        <div class="form-group">
            <label for="pwd">New Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="pwd2">Confirm Password:</label>
            <input type="password" class="form-control" id="passwordconfirm" name="passwordconfirm">
        </div>
        <input type="submit" class="btn btn-primary">
    </form>
</div>
</body>
</html>