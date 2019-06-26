<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../index.php");
    exit(0);
}

$user_id = $_SESSION['user_id'];

function change_picture($user_id, $file_temp, $file_extn) {
    $file_path = '../pictures/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
    move_uploaded_file($file_temp, $file_path);
    include_once 'db/connection.php';

    $db_query = $db_connection->prepare("SELECT * FROM users WHERE id = :user_id");
    $db_query->execute([
        ':user_id' => $user_id
    ]);
    $rows = $db_query->rowCount();
    foreach ($rows as $row) {
        $pic = $row['picture'];
        if ($pic != 'default_picture.png') {
            unlink($pic);
        }
    }

    $db_sql_statement = $db_connection->prepare("UPDATE users SET picture = :file_path WHERE id = :user_id");
    $db_sql_statement->execute([
        ':file_path' => $file_path,
        ':user_id' => $user_id
    ]);
    $_SESSION['succes'] = 'Your profile picture has been updated!';
    header("Location: ../profile.php?user_id=$user_id");
}

if (isset($_FILES['picture']) === true) {
    if (empty($_FILES['picture']['name']) === true) {
        $_SESSION['error'] = 'Please choose a file!';
        header("Location: ../settings");
        exit(0);
    } else {
        $allowed = array('jpg', 'jpeg', 'gif', 'png');

        $file_name = $_FILES['picture']['name'];
        $file_extn = strtolower(end(explode('.', $file_name)));
        $file_temp = $_FILES['picture']['tmp_name'];

        if (in_array($file_extn, $allowed) === true) {
            change_picture($user_id, $file_temp, $file_extn);
        } else {
            $_SESSION['error'] = 'Incorrect file type!';
            header("Location: ../settings.php");
            exit(0);
        }
    }
}