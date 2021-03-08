<?php
    // Logout
    session_start();
    unset($_SESSION['Email']);
    header('location: rider_login.php');
    session_destroy();
?>