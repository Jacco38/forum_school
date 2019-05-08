<?php
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    echo '<nav>
    <div class="fluid">
        <div class="name">
            <a href="index.php">JKForum</a>
        </div>
        <div class="nav">
            <li><a href="index.php">Threads</a></li>
        </div>
    </div>
    <div class="username">
        <li><a href="#">'.$username_menu.'</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="app/logout.php">Logout</a></li>
    </div>
</nav>';
} else if (!isset($_SESSION['username']) && !isset($_SESSION['user_id'])) {
    echo '<nav>
    <div class="fluid">
        <div class="name">
            <a href="index.php">JKForum</a>
        </div>
        <div class="nav">
            <li><a href="index.php">Threads</a></li>
        </div>
    </div>
    <div class="username">
        <li><a href="#">'.$username_menu.'</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
    </div>
</nav>';
}