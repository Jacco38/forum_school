<?php
include_once 'app/templates/bovenstuk.php';
?>
<title>JKForum - Topics</title>
</head>
<div class="jumbotron">
    <?php

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

    $thread_id = $_GET['thread'];
    $db_query = $db_connection->prepare("SELECT name FROM threads WHERE id = :thread_id");
    $db_query->execute([
        ':thread_id' => $thread_id
    ]);

    $rows = $db_query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        // Hier word de knop Add Topic laten zien als je bent ingelogd
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
        // Hier wordt alle informatie van topics gehaald uit de database en word allemaal weergegeven
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

    ?>
</div>
</body>
</html>