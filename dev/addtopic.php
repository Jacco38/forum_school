<?php
include_once 'app/templates/bovenstuk.php';
$thread_id = $_GET['thread'];
?>
<title>JKForum - Add topic</title>
</head>
<div class="jumbotron">
    <h2>Add Topic</h2><hr>
    <form action="app/addtopic_handler.php?thread=<?=$thread_id ?>" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" class="form-control rounded-0"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>