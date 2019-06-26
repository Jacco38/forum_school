<?php
session_start();
include_once 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

$content = $_POST['content'];
$user_id = $_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Locaton: ../index.php');
    exit(0);
}

    $db_sql_statement = $db_connection->prepare("UPDATE users SET status = :content WHERE id = :user_id");
    $db_sql_statement->execute([
        ':content' => $content,
        'user_id' => $user_id
    ]);

    $_SESSION['succes'] = 'Your status has been changed!';
    header("Location: ../profile.php?user_id=$user_id");
    exit(0);