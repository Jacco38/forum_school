<?php

session_start();

include_once "db/connection.php";

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Locaton: ../index.php');
    exit(0);
}

$email = $_POST['email'];
$password = $_POST['password'];

try {

    $db_sql_statement = $db_connection->prepare("SELECT * FROM users WHERE email = :email");

    $db_sql_statement->execute([
        ':email' => $email
    ]);

    $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($db_sql_statement->rowCount() == 0) {
        $_SESSION['error'] = 'This account is not found!';
        header("Location: ../login.php");
        exit(0);
    }

    foreach ($rows as $row) {
        if ($row['confirmed'] == 0) {
            $passcheck = password_verify($password, $row['password']);
            if ($passcheck == true) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['admin'] = $row['admin'];
                header("Location: ../index.php");
                exit(0);
            } else {
                $_SESSION['error'] = 'This password is not correct!';
                header("Location: ../login.php");
                exit(0);
            }
        } else {
            $_SESSION['error'] = 'Please activate your account!';
            header("Location: ../login.php");
            exit(0);
        }
    }
} catch (PDOException $error){
    echo $error->getMessage();
    die();
}