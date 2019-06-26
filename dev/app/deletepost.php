<?php
session_start();

include_once 'db/connection.php';

$thread_id = $_GET['thread'];
$topic_id = $_GET['topic'];

$db_sql_statement = $db_connection->prepare("SELECT * FROM topics WHERE thread_id = :thread_id AND id = :topic_id");
$db_sql_statement->execute([
    ':thread_id' => $thread_id,
    ':topic_id' => $topic_id
]);

$rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    $user_id = $row['user_id'];

    if ($user_id == $_SESSION['user_id'] || $_SESSION['admin'] == 1) {
        $db_query = $db_connection->prepare("DELETE FROM topics WHERE thread_id = :thread_id AND id = :topic_id");
        $db_query->execute([
            ':thread_id' => $thread_id,
            ':topic_id' => $topic_id
        ]);
        $db_query = $db_connection->prepare("DELETE FROM replies WHERE topic_id = :topic_id");
        $db_query->execute([
            ':topic_id' => $topic_id
        ]);
        $_SESSION['succes'] = 'This post has been deleted!';
        header("Location: ../index.php?thread=$thread_id");
        exit(0);
    } else {
        $_SESSION['error'] = "You don't have the permission to delete this post!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit(0);
    }
}