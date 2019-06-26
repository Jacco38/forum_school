<?php
    include_once 'app/templates/bovenstuk.php';
?>
<title>JKForum - Threads</title>
</head>
<body>
    <div class="jumbotron">
        <h1>Threads</h1><hr>
        <?php

        // Deze functie zit in 'app/content_functions.php'
        show_threads();

        ?>
    </div>
</body>
</html>