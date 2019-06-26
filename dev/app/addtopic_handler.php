<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

$thread_id = $_GET['thread'];
$name = $_POST['name'];
$content = $_POST['content'];

include_once 'db/connection.php';

try {

    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
        $db_query_statement = $db_connection->prepare("INSERT INTO topics (thread_id, user_id, name, content, status) VALUES (:thread_id, :user_id, :name, :content, 1)");

        $db_query_statement->execute([
            ':thread_id' => $thread_id,
            ':user_id' => $_SESSION['user_id'],
            ':name' => $name,
            ':content' => $content
        ]);

        header("Location: ../thread.php?thread=$thread_id");
        exit(0);
    } else {
        $_SESSION['error'] = 'Please login to add a topic!';
        header("Location: ../login.php");
        exit(0);
    }

} catch (PDOException $error){
    echo $error->getMessage();
    die();
}