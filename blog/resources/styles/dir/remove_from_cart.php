<?php
    require 'open_user_connection.php';
    
    if (isset($_POST['remove'])) {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        
        header("Location: /shop/cart");
    }
?>