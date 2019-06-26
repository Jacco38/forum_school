<?php
include_once 'app/templates/bovenstuk.php';
$thread_id = $_GET['thread'];
$topic_id = $_GET['topic'];
?>
<title>JKForum - Add reply</title>
</head>
<div class="jumbotron">
    <h2>Add reply</h2><hr>
    <form action="app/addreply_handler.php?thread=<?=$thread_id ?>&topic=<?=$topic_id ?>" method="POST">
        <div class="form-group">
            <textarea name="content" class="form-control rounded-0" id="exampleFormControlTextarea1"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>