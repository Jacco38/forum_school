<?php
include_once 'app/templates/bovenstuk.php';
$user_id = $_SESSION['user_id'];

?>
<title>JKForum - Settings</title>
</head>
<body>
    <div class="jumbotron">
        <?php
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            echo "<div class='alert alert-danger'>
        <strong>Error!</strong> $error
        </div>";
            unset($_SESSION['error']);
        }
        ?>
        <h4>Change profile picture:</h4>
        <form action="app/addpicture.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="picture"><br>
            <button type='submit' class='btn btn-primary' style="margin-top: 20px;">Submit</button><br><br>
        </form>
        <h4>Change status:</h4>
        <?php

        $db_sql_statement = $db_connection->prepare("SELECT status FROM users WHERE id = :user_id");
        $db_sql_statement->execute([
                ':user_id' => $user_id
        ]);
        $rows = $db_sql_statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $status = $row['status'];
            echo "<form action='app/changestatus.php' method='POST'>
                <textarea name='content' class='form-control rounded-0'>$status</textarea><br>
                <button type='submit' class='btn btn-primary'>Submit</button>
            </form>";
        }

        ?>
    </div>
</body>