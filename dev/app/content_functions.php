<?php

// Functie om de threads te laten zien
function show_threads() {
    include 'db/connection.php';

    if (isset($_SESSION['succes'])) {
        $succes = $_SESSION['succes'];
        echo "<div class='alert alert-success'>
    <strong>Succes!</strong> $succes
    </div>";
        unset($_SESSION['succes']);
    }

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
            <strong>Error!</strong> $error
            </div>";
        unset($_SESSION['error']);
    }

    $db_sql_statement = $db_connection->prepare("SELECT * FROM threads");
    $db_sql_statement->execute();

    $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        // Hier wordt alle informatie van threads gehaald uit de database en word allemaal weergegeven
        $thread_id = $row['id'];
        $name = $row['name'];
        $content = $row['content'];
        echo "<div>
        <a class='link' href='thread.php?thread=$thread_id'><h3>$name</h3></a>
        <p>$content</p>
        </div><br>";
    }
}

// Functie om de topics te laten zien in thread.php
function show_topics() {
    include 'db/connection.php';
    $thread_id = $_GET['thread'];

    $db_query = $db_connection->prepare("SELECT name FROM threads WHERE id = :thread_id");
    $db_query->execute([
        ':thread_id' => $thread_id
    ]);

    $rows = $db_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $name = $row['name'];
        echo "
        <h1>$name</h1><hr>";
        if (isset($_SESSION['user_id'])) {
            echo "<a class='addtopic' href='addtopic.php?thread=$thread_id'>Add topic</a>";
        }
    }

    $db_sql_statement = $db_connection->prepare("SELECT topics.*, users.username, users.picture FROM topics LEFT JOIN users ON topics.user_id = users.id WHERE topics.thread_id = :thread_id ORDER BY topics.id DESC");
    $db_sql_statement->execute([
        ':thread_id' => $thread_id
    ]);

    $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $topic_id = $row['id'];
        $name = htmlspecialchars($row['name']);
        $user_id = $row['user_id'];
        $user = htmlspecialchars($row['username']);
        echo "<div>
        <a class='link' href='topic.php?thread=$thread_id&topic=$topic_id'><h3>$name</h3></a>
        <p>By: <a style='color: black !important;' href='profile.php?user_id=$user_id'>$user</a></p>
        </div><br>";
    }

    $rowcount = $db_sql_statement->rowCount();

    if ($rowcount == 0) {
        echo "<div class='topic'>
        <a class='title'>There are no topics yet!</a>
        </div>";
    }
}

// Functie om je profile te laten zien
function show_profile() {
    include 'db/connection.php';
    $user_id = $_GET['user_id'];

    if (isset($_SESSION['succes'])) {
        $succes = $_SESSION['succes'];
        echo "<div class='alert alert-success'>
    <strong>Succes!</strong> $succes
    </div>";
        unset($_SESSION['succes']);
    }

    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_id'] == $user_id) {
            echo '<a class="settings-button" href="settings.php">Settings</a><br>';
        }
    }

    echo '<div class="text-center">';

        $db_query = $db_connection->prepare("SELECT * FROM users WHERE id = :user_id");
        $db_query->execute([
            ':user_id' => $user_id
        ]);

        $rows = $db_query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            // Hier wordt alle informatie van users gehaald uit de database en word allemaal weergegeven
            $name = htmlspecialchars($row['username']);
            $status = htmlspecialchars($row['status']);
            $picture = htmlspecialchars($row['picture']);
            echo "<div class='text-center'>
            <img src='pictures/$picture' class='profile-picture rounded-circle'>
            <h2>$name</h2>
            <p>$status</p>
            </div><hr>";
        }
}

// Functie om je recente posts te laten zien op je profiel
function show_profile_posts() {
    include 'db/connection.php';
    $user_id = $_GET['user_id'];

    $db_sql_statement = $db_connection->prepare("SELECT * FROM topics WHERE user_id = :user_id ORDER BY id DESC");
        $db_sql_statement->execute([
            ':user_id' => $user_id
        ]);

        if ($db_sql_statement->rowCount() == 0) {
            echo "<div class='topic'><h2 style='font-weight: normal'>There is nothing posted by this user!</h2></div>";
        } else {
            $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                // Hier wordt alle informatie van topics gehaald uit de database en word allemaal weergegeven
                $name = htmlspecialchars($row['name']);
                $content = htmlspecialchars($row['content']);
                $thread_id = $row['thread_id'];
                $topic_id = $row['id'];
                echo "<div>
                <a class='link' href='topic.php?thread=$thread_id&topic=$topic_id'><h5>$name</h5></a><br>
                </div>";
            }
        }
}