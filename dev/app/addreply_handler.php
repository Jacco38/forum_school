<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

$thread_id = $_GET['thread'];
$topic_id = $_GET['topic'];
$content = $_POST['content'];

include_once 'db/connection.php';

try {

    if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
        $db_query_statement = $db_connection->prepare("INSERT INTO replies (thread_id, topic_id, user_id, content) VALUES (:thread_id, :topic_id, :user_id, :content)");

        $db_query_statement->execute([
            ':thread_id' => $thread_id,
            ':topic_id' => $topic_id,
            ':user_id' => $_SESSION['user_id'],
            ':content' => $content
        ]);

        header("Location: ../topic.php?thread=$thread_id&topic=$topic_id");
        exit(0);
    } else {
        $_SESSION['error'] = 'Please login to add a reply!';
        header("Location: ../login.php");
        exit(0);
    }

} catch (PDOException $error){
    echo $error->getMessage();
    die();
}