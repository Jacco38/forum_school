<?php
include_once 'app/templates/bovenstuk.php';
$thread_id = $_GET['thread'];
$topic_id = $_GET['topic'];
?>
<title>JKForum - Topic</title>
</head>
<body>
    <script>
        
        // Deze functie word uitgevoerd als je op de knop Delete Post hebt geklikt
        function confirmdelete() {
            if (confirm('Are you sure you want to delete this post?')) {
                window.open('app/deletepost.php?thread=<?=$thread_id ?>&topic=<?=$topic_id ?>','_self');
            }
        }

    </script>
<div class="jumbotron">
    <?php

    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
        unset($_SESSION['error']);
    }

    $topic_id = $_GET['topic'];
    $thread_id = $_GET['thread'];

    $db_sql_statement = $db_connection->prepare("SELECT topics.*, users.username FROM topics LEFT JOIN users ON topics.user_id = users.id WHERE topics.thread_id = :thread_id AND topics.id = :topic_id");
    $db_sql_statement->execute([
        ':thread_id' => $thread_id,
        ':topic_id' => $topic_id
    ]);

    $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        // Hier word de knop Delete Post laten zien als de post die je bekijkt van jou is of als je een admin bent
        $username = htmlspecialchars($row['username']);
        $name = htmlspecialchars($row['name']);
        $content = htmlspecialchars($row['content']);
        $user_id = $row['user_id'];

        if (isset($_SESSION['user_id'])) {
            if ($user_id == $_SESSION['user_id'] || $_SESSION['admin'] == 1) {
                echo "<button onclick='confirmdelete()' class='btn btn-primary addreply'>Delete post</button><br><br>";
            }
        }

        echo "<div>
        <h1>$name</h1>
        <p>By: <a style='color: black !important;' href='profile.php?user_id=$user_id'>$username</a></p>
    </div>
    <div class='topic'>
        <p>$content</p>
        <br>
        <hr>
    </div>";
    }

    ?>
    <div class="replies">
        <h4>Replies</h4>
        
        <?php

        if (isset($_SESSION['user_id'])) {
            echo "<a class='addreply' href='addreply.php?thread=$thread_id&topic=$topic_id'>Add Reply</a><br><br>";
        }

        $db_query = $db_connection->prepare("SELECT replies.*, users.username, users.picture FROM replies LEFT JOIN users ON replies.user_id = users.id WHERE replies.topic_id = :topic_id ORDER BY replies.id ASC");
        $db_query->execute([
            ':topic_id' => $topic_id
        ]);

        $rows = $db_query->fetchAll(PDO::FETCH_ASSOC);

        $replycount = $db_query->rowCount();

        if ($replycount == 0) {
            echo "<p>There are no replies yet!</p>";
        }

        foreach ($rows as $row) {
            // Hier wordt alle informatie van replies gehaald uit de database en word allemaal weergegeven
            $username2 = htmlspecialchars($row['username']);
            $content2 = htmlspecialchars($row['content']);
            $user_id = $row['user_id'];
            $picture = $row['picture'];
            echo "<div class='media border p-3'>
            <img src='pictures/$picture' class='mr-3 mt-3 rounded-circle' style='width:60px; height: 60px;'>
            <div class='media-body'>
                <a style='color: black !important;' href='profile.php?user_id=$user_id'><h4>$username2</h4></a>
                <p>$content2</p>
            </div><br>
            </div><br>";
        }

        ?>
</div>
</body>
</html>