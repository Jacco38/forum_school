<?php
include_once 'app/templates/bovenstuk.php';
$user_id = $_GET['user_id'];

?>
<title>JKForum - Profile</title>
</head>
<body>
    <div class="jumbotron">
        <?php

    // Deze functie zit in 'app/content_functions.php'
        show_profile();

        ?>
        </div>
        <h4>Most recent posts:</h4><br>
        <?php

    // Deze functie zit in 'app/content_functions.php'
        show_profile_posts();

        ?>
    </div>
</body>