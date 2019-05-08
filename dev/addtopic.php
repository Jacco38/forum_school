<?php
session_start();
include_once "app/loggedin_check.php";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Add Topic</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include_once "app/templates/menu.php";
?>
<div id="content">
    <div class="topic">
        <a>Add reply</a>
    </div>
    <form class="addtopic" method="POST" action="app/addtopic_handler.php">
        <textarea class="reply_text" name="reply"></textarea><br>
        <input type="submit" value="Submit">
    </form>
</div>
<footer>

</footer>
</body>

</html>