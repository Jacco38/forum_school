<?php
session_start();
include_once "app/loggedin_check.php";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Topic</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include_once "app/templates/menu.php";
?>
<div id="content">
    <div class="topic">
        <a class="threadtitle">Topic 1</a>
        <a class="addreply" href="addreply.php">Add reply</a>
        <p class="topicuser">By: Jacco</p>
    </div>
    <div class="topic">
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatibus corporis omnis corrupti, aliquid minus soluta harum veniam aperiam possimus, incidunt nobis, quibusdam sit ducimus! Minus voluptatibus amet cupiditate quos aut.</p>
        <br>
        <hr>
    </div>
    <div class="replies">
        <a class="repliestitle">Replies</a>
        <div class="reply">
            <a>User 1</a>
            <p class="replycontent"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum aliquid quos quo ratione, perferendis fugit dolorum sequi impedit ipsa eligendi aliquam sunt magni at. Vel minima iste quos quasi ab.</p>
        </div>
        <div class="reply">
            <a>User 2</a>
            <p class="replycontent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere voluptate quos atque voluptates impedit et veritatis, exercitationem sit quibusdam maxime mollitia illo harum quod error magnam sint est sed quam.</p>
        </div>
    </div>
</div>
<footer>

</footer>
</body>

</html>