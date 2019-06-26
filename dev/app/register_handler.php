<?php

session_start();

include_once "db/connection.php";

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Locaton: ../index.php');
    exit(0);
}

$email = $_POST['email'];
$user = $_POST['username'];
$password = $_POST['password'];
$passconfirm = $_POST['confirm'];
$confirmcode = rand();

if (!isset($email) || !isset($user) || !isset($password) || !isset($passconfirm)) {
    $_SESSION['error'] = 'Please fill in everything!';
    header("Location: ../register.php");
    exit(0);
}

try {

    if ($password == $passconfirm) {

        $db_query = $db_connection->prepare("SELECT * FROM users WHERE username = :username OR email = :email");

        $db_query->execute([
            ':username' => $user,
            ':email' => $email
        ]);

        if ($db_query->rowCount() > 0) {
            $_SESSION['error'] = 'This email / username is already used!';
            header("Location: ../register.php");
            exit(0);
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $db_sql_statement = $db_connection->prepare("INSERT INTO users (username, email, password, status, picture, admin,  confirmed, confirmcode) VALUES (:username, :email, :password, 'This user has no status yet!', 'default_picture.png', 0, 0, :confirmcode)");

            $db_sql_statement->execute([
                ':username' => $user,
                ':email' => $email,
                ':password' => $hash,
                ':confirmcode' => $confirmcode
            ]);

            $message = "Please click here to activate your account: http://http://jkforum.cmshost.nl/app/confirm.php?email=$email&confirmcode=$confirmcode";

            $_SESSION['succes'] = 'Your account has been made!';
            header("Location: ../index.php");
            exit(0);
        }

    } else {
        $_SESSION['error'] = 'Your passwords are not the same!';
        header("Location: ../register.php");
        exit(0);
    }

} catch (PDOException $error){
    echo $error->getMessage();
    die();
}