<?php
    session_start();
    include_once "app/loggedin_check.php";
?>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="author" charset="Jacco Koridon">
    <title>JkForum - Threads</title>
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
    <?php

        if (isset($_SESSION['succes'])) {
            echo '<div class="succes"><a>'.$_SESSION['succes'].'</a></div>';
            unset($_SESSION['succes']);
        } elseif (isset($_SESSION['error'])) {
            echo '<div class="error"><a>'.$_SESSION['error'].'</a></div>';
            unset($_SESSION['error']);
        }

    ?>
    <div class="thread">
        <a class="title" href="thread.php">Thread 1</a>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis quas tempore rem nesciunt distinctio obcaecati fugit quae. Reiciendis fuga corporis porro consectetur quia. Voluptas a explicabo eligendi distinctio tenetur officia?</p>
    </div>
    <div class="thread">
        <a class="title">Thread 2</a>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius fuga expedita laboriosam hic deserunt, ex accusamus voluptates corporis architecto distinctio enim non numquam odio facilis qui ad quaerat consectetur suscipit.</p>
    </div>
    <div class="thread">
        <a class="title">Thread 3</a>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto, eius mollitia ab placeat, repellendus necessitatibus delectus assumenda aspernatur ex vel eligendi itaque soluta suscipit quae quibusdam magni tempora numquam ea.</p>
    </div>
    <div class="thread">
        <a class="title">Thread 4</a>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam officia dignissimos placeat corporis facilis labore odit veniam magni libero sed. Doloremque beatae temporibus quisquam vel voluptatum quia qui obcaecati atque!</p>
    </div>
</div>
<footer>

</footer>
</body>

</html>