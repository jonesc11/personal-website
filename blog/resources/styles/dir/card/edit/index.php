<?php
    require("../../open_user_connection.php");
    
    if (empty($_SESSION['user'])) {
        header("Location: /account/login");
        $db = null;
        die("Redirecting...");
    }
    
    if ($_SESSION['user']['active'] != 1) {
        header("Location: /account/login");
        $db = null;
        die("Redirecting...");
    }
    
    if ($_SESSION['user']['permissions'] != 1) {
        header("Location: /");
        $db = null;
        die("Redirecting...");
    }
?>
<html>
    <head>
        <title>Edit Card - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_card_edit.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Edit Existing Card</h1>
        
        <?php
            $card_id = $_GET['id'];
            
            $query = "SELECT * FROM `cards` WHERE `id`=:id;";
            
            $statement = $db->prepare($query);
            
            $id = $card_id;
            $statement->execute(array(':id' => $id));
            
            $card = array();
            
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $card = $row;
            } else {
                echo 'Card not found.';
            }
            
            $imgLink = '/resources/images/card-images/'.$card['img_lnk'];
            $name = $card['name'];
            $edition = $card['edition'];
            $rarity = $card['rarity'];
            $quantity = $card['quantity'];
            $price = $card['price'];
            $id = $card['id'];
            $language = $card['language'];
            $condition = $card['card_condition'];
            $description = $card['description'];
            
            $rarity_str = '';
            $edition_str = '';
            $language_str = '';
            $condition_str = '';
            
            if ($rarity == 1) {
                $rarity_str = 'Common';
            } else if ($rarity == 2) {
                $rarity_str = 'Rare';
            } else if ($rarity == 3) {
                $rarity_str = 'Super Rare';
            } else if ($rarity == 4) {
                $rarity_str = 'Ultra Rare';
            } else if ($rarity == 5) {
                $rarity_str = 'Ultimate Rare';
            } else if ($rarity == 6) {
                $rarity_str = 'Secret Rare';
            } else if ($rarity == 7) {
                $rarity_str = 'Ghost Rare';
            } else if ($rarity == 8) {
                $rarity_str = 'Gold Rare';
            } else if ($rarity == 9) {
                $rarity_str = 'Platinum Rare';
            } else if ($rarity == 10) {
                $rarity_str = 'Duelist League';
            }
            
            if ($edition == 1) {
                $edition_str = 'First';
            } else if ($edition == 2) {
                $edition_str = 'Unlimited';
            } else if ($edition == 3) {
                $edition_str = 'Limited';
            }
            
            if ($language == 1) {
                $language_str = 'English';
            } else if ($language == 2) {
                $language_str = 'German';
            } else if ($language == 3) {
                $language_str = 'French';
            } else if ($language == 4) {
                $language_str = 'Italian';
            } else if ($language == 5) {
                $language_str = 'Spanish';
            } else if ($language == 6) {
                $language_str = 'Portuguese';
            }
            
            if ($condition == 1) {
                $condition_str = 'NM';
            } else if ($condition == 2) {
                $condition_str = 'VLP';
            } else if ($condition == 3) {
                $condition_str = 'LP';
            } else if ($condition == 4) {
                $condition_str = 'MP';
            } else if ($condition == 5) {
                $condition_str = 'HP';
            } else if ($condition == 6) {
                $condition_str = 'D';
            }
            
            echo '<form name="edit_image" action="edit_handler.php" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Image: <img height="338px" width="225px" src="'.$imgLink.'" alt="No image"/><br/>';
            echo 'Upload new image: <input type="file" name="new_image"/>';
            echo '<input type="submit" value="Change Image" name="submit_image"/><br/></form>';
            echo '<form name="edit_name" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Name: '.$name.'<br/>';
            echo 'Change name to: <input type="text" name="name"/>';
            echo '<input type="submit" value="Change Name" name="submit_name"/><br/></form>';
            echo '<form name="edit_quan" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Quantity: '.$quantity.'<br/>';
            echo 'Change Quantity to: <input type="text" name="quantity"/>';
            echo '<input type="submit" value="Change Quantity" name="submit_quantity"/><br/></form>';
            echo '<form name="edit_price" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Price: '.$price.'<br/>';
            echo 'Change price to: <input type="text" name="price"/>';
            echo '<input type="submit" value="Change Price" name="submit_price"/><br/></form>';
            echo '<form name="edit_rarity" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Rarity: '.$rarity_str.'<br/>Change rarity to: <select name="rarity">';
            echo '<option value=1>Common</option>';
            echo '<option value=2>Rare</option>';
            echo '<option value=3>Super Rare</option>';
            echo '<option value=4>Ultra Rare</option>';
            echo '<option value=5>Ultimate Rare</option>';
            echo '<option value=6>Secret Rare</option>';
            echo '<option value=7>Ghost Rare</option>';
            echo '<option value=8>Gold Rare</option>';
            echo '<option value=9>Platinum Rare</option>';
            echo '<option value=10>Duelist League</option>';
            echo '</select><input type="submit" value="Change Rarity" name="submit_rarity"/><br/></form>';
            echo '<form name="edit_edition" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Edition: '.$edition_str.'<br/>';
            echo 'Change edition to: <select name="edition">';
            echo '<option value=1>First</option>';
            echo '<option value=2>Unlimited</option>';
            echo '<option value=3>Limited</option>';
            echo '</select><input type="submit" value="Change Edition" name="submit_edition"/><br/></form>';
            echo '<form name="edit_cond" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Condition: '.$condition_str.'<br/>';
            echo 'Change condition to: <select name="condition">';
            echo '<option value=1>NM</option>';
            echo '<option value=2>VLP</option>';
            echo '<option value=3>LP</option>';
            echo '<option value=4>MP</option>';
            echo '<option value=5>HP</option>';
            echo '<option value=6>D</option>';
            echo '</select><input type="submit" value="Change Condition" name="submit_condition"/><br/></form>';
            echo '<form name="edit_lang" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'">';
            echo 'Language: '.$language_str.'<br/>';
            echo 'Change language to: <select name="language">';
            echo '<option value=1>English</option>';
            echo '<option value=2>German</option>';
            echo '<option value=3>French</option>';
            echo '<option value=4>Italian</option>';
            echo '<option value=5>Spanish</option>';
            echo '<option value=6>Portuguese</option>';
            echo '</select>';
            echo '<input type="submit" value="Change Language" name="submit_language"/><br/></form>';
            echo '<form name="edit_desc" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="card_id" value="'.$id.'"/>';
            echo 'Description: '.$description.'<br/>';
            echo 'Change description to: <textarea maxlength=1500 name="description"></textarea>';
            echo '<input type="submit" value="Change Description" name="submit_desc"/><br/></form>';
        ?>
        
        <a href="/account/admin/update-inventory" title="Return to current inventory">Return to current inventory.</a>
    </body>
</html>