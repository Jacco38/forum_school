<?php

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" style="margin-left:10% !important;" href="index.php">JKForum</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="quotes.php">Quotes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="eeee.php">EEEE</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="margin-right: 10%;">
        <li class="nav-item">
            <a class="nav-link" href="app/logout.php">Logout</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php?user_id='.$_SESSION['user_id'].'">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link">'.$username_menu.'</a>
        </li>
    </ul>
</nav>';
} else {
    echo '<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" style="margin-left:10% !important;" href="index.php">JKForum</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="quotes.php">Quotes</a>
        </li>    
        <li class="nav-item">
            <a class="nav-link" href="eeee.php">EEEE</a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="margin-right: 10%;">
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link">'.$username_menu.'</a>
        </li>
    </ul>
</nav>';
}