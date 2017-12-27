<?php
    require ('open_user_connection.php');
    
    if (isset($_POST['submit']) && isset($_POST['search'])) {
        $search_query = filter_var($_POST['search'], FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARACTERS);
        if (isset($_POST['flags'])) {
            $search_filter = filter_var($_POST['flags'], FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARACTERS);
        }
        header ('Location: /shop?q='.$search_query.'&f='.$search_filter);
    }
?>