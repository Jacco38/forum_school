<?php

session_start();
include_once 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

$email = $_POST['email'];
$newpasscode = rand();

try {

    $db_sql_statement = $db_connection->prepare("SELECT * FROM users WHERE email = :email");
    $db_sql_statement->execute([
        ':email' => $email
    ]);

    $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

    if ($db_sql_statement->rowCount() > 0) {

        foreach ($rows as $row) {
            $db_query = $db_connection->prepare("UPDATE users SET newpasscode = :newpasscode WHERE email = :email");
            $db_query->execute([
                'newpasscode' => $newpasscode,
                ':email' => $email
            ]);
            $_SESSION['succes'] = 'Check your email to reset your password';
            header("Location: ../index.php");
            exit(0);
        }

    } else {
        header("Location: ../forgotpass.php");
        $_SESSION['error'] = 'This account does not exist!';
        exit(0);
    }

} catch (PDOException $error) {
    $error->getMessage();
    die();
}