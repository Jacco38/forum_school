<?php
if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
    $username_menu = $_SESSION['username'];
} else {
    $username_menu = 'Guest';
}