<?php
    require 'open_user_connection.php';
    
    unset($_SESSION['user']);
    header("Location: /");
    $db = null;
    die("Redirecting...");
?>