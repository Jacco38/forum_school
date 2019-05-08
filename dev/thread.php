<?php
session_start();
include_once "app/loggedin_check.php";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Topics</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
include_once "app/templates/menu.php";
?>
<div id="menu">
    <p>hallo</p>
</div>
<div id="content">
    <div class="topic">
        <a class="threadtitle">Thread 1</a>
        <a class="addreply" href="addtopic.php">Add topic</a>
    </div>
    <div class="topic">
        <a class="title" href="topic.php">Topic 1</a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quod quasi aliquid accusamus! Pariatur maxime suscipit porro voluptatem sit necessitatibus recusandae quaerat. Ab dolore beatae eum iste voluptatem sequi eligendi.</p>
    </div>
    <div class="topic">
        <a class="title">Topic 2</a>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quis eos qui omnis officiis optio iusto beatae, veritatis ab corporis facilis cumque aperiam obcaecati, dolores possimus expedita alias quas! Blanditiis, necessitatibus.</p>
    </div>
</div>
<footer>

</footer>
</body>

</html>