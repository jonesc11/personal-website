<?php
    require("../../../../open_user_connection.php");
    
    $save_directory = "/home/cardoverflow/public_html/resources/images/card-images/";
    $save_file = $save_directory . basename($_FILES['image']['name']);
    $continue = true;
    $filetype = pathinfo($save_file, PATHINFO_EXTENSION);
    
    $filename = basename($_FILES['image']['name']);
    $name = '';
    $rarity = '';
    $edition = '';
    $price = '';
    $condition = '';
    $language = '';
    $description = '';
    
    if (isset($_POST['submit_create'])) {
        $name = $_POST['name'];
        $rarity = $_POST['rarity'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $condition = $_POST['condition'];
        $language = $_POST['language'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        
        $check = getimagesize($_FILES['image']['tmp_name']);
        
        if (!($check !== false)) {
            echo '<script>';
            echo 'alert("File is not an image.");';
            echo 'window.location = "/account/admin/update-inventory/create-card";';
            echo '</script>';
            $continue = false;
        }
    }
    
    if (file_exists($save_file) && $continue) {
        echo '<script>';
        echo 'alert("Image by that name already exists.");';
        echo 'window.location = "/account/admin/update-inventory/create-card";';
        echo '</script>';
        $continue = false;
    }
    
    if ($_FILES['image']['size'] > 500000 && $continue) {
        echo '<script>';
        echo 'alert("Image is too large.");';
        echo 'window.location = "/account/admin/update-inventory/create-card";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue && $filetype != "jpg" && $filetype != "gif" && $filetype != "png" && $filetype != "jpeg") {
        echo '<script>';
        echo 'alert("File is not of the correct type.");';
        echo 'window.location = "/account/admin/update-inventory/create-card";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue && !is_numeric($price)) {
        echo '<script>';
        echo 'alert("Price is not a numeric value.");';
        echo 'window.location = "/accounts/admin/update-inventory/create-card";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $save_file)) {
            $query = 'INSERT INTO cards (price, rarity, edition, `img_lnk`, name, card_condition, language, description, quantity) VALUES (:price, :rarity, :edition, :img, :name, :condition, :language, :description, :quantity)';
            
            $query_parameters = array ( ':name'        => $name,
                                        ':rarity'      => $rarity,
                                        ':edition'     => $edition,
                                        ':price'       => $price,
                                        ':img'         => $filename,
                                        ':condition'   => $condition,
                                        ':language'    => $language,
                                        ':description' => $description,
                                        ':quantity'    => $quantity);
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
            
            $last_id = $db->lastInsertId();
            
            header("Location: /card/edit?id=".$last_id);
        } else {
            echo '<script>';
            echo 'alert("An error occurred in uploading the file.");';
            echo 'window.location = "/account/admin/update-inventory/create-card";';
            echo '</script>';
        }
    }
?>