<?php

session_start();
include_once 'db/connection.php';

$email = $_GET['email'];
$code = $_GET['code'];
$password = $_POST['password'];
$passwordconfirm = $_POST['passwordconfirm'];

if ($password != $passwordconfirm) {
    $_SESSION['error'] = 'The passwords are not the same!';
    header("Location: ../resetpass.php?email=$email&code=$code");
    exit(0);
}

try {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $db_sql_statement = $db_connection->prepare("UPDATE users SET password = :hash, newpasscode = 0 WHERE email = :email");
    $db_sql_statement->execute([
        ':hash' => $hash,
        ':email' => $email
    ]);

    $_SESSION['succes'] = 'Your password has been reset!';
    header("Location: ../index.php");
    exit(0);

} catch (PDOException $error) {
    $error->getMessage();
    die();
}