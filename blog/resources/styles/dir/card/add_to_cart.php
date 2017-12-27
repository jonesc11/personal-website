<?php
    require('../open_user_connection.php');
    
    if (isset($_POST['submit_order'])) {
        $quan_left = $_POST['quan_left'];
        $quan_ordered = $_POST['quan_ordered'];
        $card_id = $_POST['id'];
        $continue = true;
        
        if (strval($quan_ordered) != strval(intval($quan_ordered))) {
            echo '<script>';
            echo 'alert("Quantity must be an integer.");';
            echo 'window.location = "/shop";';
            echo '</script>';
            $continue = false;
        }
        
        if ($continue && $quan_left < $quan_ordered) {
            echo '<script>';
            echo 'alert("You ordered more cards than are in stock.");';
            echo 'window.location = "/shop";';
            echo '</script>';
            $continue = false;
        }
        
        if ($continue && $quan_ordered < 1) {
            echo '<script>';
            echo 'alert("Quantity must be a positive integer.");';
            echo 'window.location = "/shop";';
            echo '</script>';
            $continue = false;
        }
        
        if ($continue) {
            $new_card['id'] = filter_var($card_id, FILTER_SANITIZE_STRING);
            $new_card['quantity'] = $quan_ordered;
            if (isset($_SESSION['cart'])) {
                if (isset($_SESSION['cart'][$card_id])) {
                    $new_card['quantity'] = $new_card['quantity'] + $_SESSION['cart'][$card_id]['quantity'];
                    unset($_SESSION['cart'][$card_id]);
                }
            }
            $_SESSION['cart'][$card_id] = $new_card;
            
            header("Location: /shop/cart");
        }
    }
?>