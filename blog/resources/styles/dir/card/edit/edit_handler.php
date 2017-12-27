<?php
    require("../../open_user_connection.php");
    
    $card_id = $_POST['card_id'];
    
    if (isset($_POST['submit_image'])) {
        $card_id = $_POST['card_id'];
        $save_directory = "/home/cardoverflow/public_html/resources/images/card-images/";
        $save_file = $save_directory.basename($_FILES['new_image']['name']);
        $continue = true;
        $filetype = pathinfo($save_file, PATHINFO_EXTENSION);
        $filename = basename($_FILES['new_image']['name']);
        
        $check = getimagesize($_FILES['new_image']['tmp_name']);
        
        if (!($check !== false)) {
            echo '<script>';
            echo 'alert("File is not an image.");';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
            $continue = false;
        }
        
        if (file_exists($save_file) && $continue) {
            echo '<script>';
            echo 'alert("Image by that name already exists.")';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
            $continue = false;
        }
        
        if ($_FILES['new_image']['size'] > 500000 && $continue) {
            echo '<script>';
            echo 'alert("Image is too large.")';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
            $continue = false;
        }
        
        if ($filetype != "jpg" && $filetype != "gif" && $filetype != "png" && $continue) {
            echo '<script>';
            echo 'alert("File is not of the correct type.");';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
            $continue = false;
        }
        
        if ($continue) {
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $save_file)) {
                $query = 'UPDATE cards SET `img_lnk`=:img WHERE `id`=:id';
                
                $query_parameters = array( ':img' => $filename,
                                           ':id' => $card_id );
                
                $statement = $db->prepare($query);
                $result = $statement->execute($query_parameters);
            } else {
                echo '<script>';
                echo 'alert("File not properly uploaded.");';
                echo 'window.location = "/card/edit?id='.$card_id.'";';
                echo '</script>';
            }
        }
    }
    
    if (isset($_POST['submit_name'])) {
        $card_id = $_POST['card_id'];
        $name = $_POST['name'];
        
        $query = 'UPDATE `cards` SET `name`=:name WHERE `id`=:id';
        $query_parameters = array ( ':name' => $name,
                                    ':id' => $card_id );
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_quantity'])) {
        $card_id = $_POST['card_id'];
        $quantity = $_POST['quantity'];
        
        
        if (strval($quantity) != strval(intval($quantity))) {
            echo '<script>';
            echo 'alert("Quantity must be an integer.");';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
        } else {
            $query = 'UPDATE `cards` SET `quantity`=:quan WHERE `id`=:id';
            $query_parameters = array ( ':quan' => $quantity,
                                        ':id' => $card_id);
            
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        }
    }
    
    if (isset($_POST['submit_price'])) {
        $card_id = $_POST['card_id'];
        $price = $_POST['price'];
        
        if (is_numeric($price)) {
            $query = 'UPDATE `cards` SET `price`=:price WHERE `id`=:id';
            $query_parameters = array ( ':price' => $price,
                                        ':id' => $card_id );
            
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        } else {
            echo '<script>';
            echo 'alert("Price must be numeric.");';
            echo 'window.location = "/card/edit?id='.$card_id.'";';
            echo '</script>';
        }
    }
    
    if (isset($_POST['submit_rarity'])) {
        $card_id = $_POST['card_id'];
        $rarity = $_POST['rarity'];
        
        $query = 'UPDATE `cards` SET `rarity`=:rarity WHERE `id`=:id';
        $query_parameters = array ( ':rarity' => $rarity,
                                    ':id' => $card_id);
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_edition'])) {
        $card_id = $_POST['card_id'];
        $edition = $_POST['edition'];
        
        $query = 'UPDATE `cards` SET `edition`=:edition WHERE `id`=:id';
        $query_parameters = array ( ':edition' => $edition,
                                    ':id' => $card_id);
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_condition'])) {
        $card_id = $_POST['card_id'];
        $condition = $_POST['condition'];
        
        $query = 'UPDATE `cards` SET `card_condition`=:condition WHERE `id`=:id';
        $query_parameters = array ( ':condition' => $condition,
                                    ':id' => $card_id);
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_language'])) {
        $card_id = $_POST['card_id'];
        $language = $_POST['language'];
        
        $query = 'UPDATE `cards` SET `language`=:language WHERE `id`=:id';
        $query_parameters = array ( ':language' => $language,
                                    ':id' => $card_id);
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_desc'])) {
        $card_id = $_POST['card_id'];
        $description = $_POST['description'];
        
        $query = 'UPDATE `cards` SET `description`=:description WHERE `id`=:id';
        $query_parameters = array ( ':description' => $description,
                                    ':id'          => $card_id );
                                    
        $statement = $db->prepare($query);
        $statement->execute($query_parameters);
    }
    
    $db = null;
    header("Location: /card/edit?id=".$card_id);
?>