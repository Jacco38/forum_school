<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

include_once ('db/connection.php');

$email = $_GET['email'];
$confirmcode = $_GET['confirmcode'];

$db_query = $db_connection->prepare("SELECT * FROM users WHERE email = :email");

$db_query->execute([
    ':email' => $email
]);

$rows = $db_query->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    try {
        if ($row['confirmcode'] == 0) {
            $_SESSION['error'] = 'This account is already activated!';
            header("Location: ../index.php");
        } else {
            if ($confirmcode == $row['confirmcode']) {

                $db_query_update = $db_connection->prepare("UPDATE users SET confirmcode = 0, confirmed = 1 WHERE email = :email");

                $db_query_update->execute([
                    ':email' => $email
                ]);

                $_SESSION['succes'] = 'Your account is now activated!';
                header("Location: ../index.php");
            } else {
                $_SESSION['error'] = 'This confirmcode is not correct!!';
                header("Location: ../index.php");
            }
        }
    } catch (PDOException $error){
        echo $error->getMessage();
        die();
    }
}