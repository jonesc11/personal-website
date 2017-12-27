<?php
    require('../open_user_connection.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php require '../resources/top_bar.php';
        require '../resources/footer.php';?>
<html>
    <head>
        <title>View Card - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_shop.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>

    <?php 
    if (isset($_GET['id'])) {
        echo '<table id="details"><tr><td rowspan="8">';
        
        $card_id = $_GET['id'];
        
        $query = "SELECT * FROM `cards` WHERE `id`=:id";
        $query_parameters = array ( ':id' => $card_id );
        
        $card = array ();
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
        
        if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $card = $row;
        }

        echo '<h2>'.$card['name'].'</h2>';
        echo '<img src="/resources/images/card-images/'.$card['img_lnk'].'" alt="No image found." height="338px" width="255px"/><br/></div>';
        echo '</td><td>Language:</td><td>';
        if ($card['language'] == 1) {
            echo 'English';
        } else if ($card['language'] == 2) {
            echo 'German';
        } else if ($card['language'] == 3) {
            echo 'French';
        } else if ($card['language'] == 4) {
            echo 'Italian';
        } else if ($card['language'] == 5) {
            echo 'Spanish';
        } else if ($card['language'] == 6) {
            echo 'Portuguese';
        }
        echo '</td></tr><tr><td>Rarity:</td><td>';
        if ($card['rarity'] == 1) {
            echo 'Common';
        } else if ($card['rarity'] == 2) {
            echo 'Rare';
        } else if ($card['rarity'] == 3) {
            echo 'Super Rare';
        } else if ($card['rarity'] == 4) {
            echo 'Ultra Rare';
        } else if ($card['rarity'] == 5) {
            echo 'Ultimate Rare';
        } else if ($card['rarity'] == 6) {
            echo 'Secret Rare';
        } else if ($card['rarity'] == 7) {
            echo 'Ghost Rare';
        } else if ($card['rarity'] == 8) {
            echo 'Gold Rare';
        } else if ($card['rarity'] == 9) {
            echo 'Platinum Rare';
        } else if ($card['rarity'] == 10) {
            echo 'Duelist Leauge';
        }
        echo '</td></tr><tr><td>Edition:</td><td>';
        if ($card['edition'] == 1) {
            echo 'First';
        } else if ($card['edition'] == 2) {
            echo 'Unlimited';
        } else if ($card['edition'] == 3) {
            echo 'Limited';
        }
        echo '</td></tr><tr><td>Condition:</td><td>';
        if ($card['card_condition'] == 1) {
            echo 'NM';
        } else if ($card['card_condition'] == 2) {
            echo 'VLP';
        } else if ($card['card_condition'] == 3) {
            echo 'LP';
        } else if ($card['card_condition'] == 4) {
            echo 'MP';
        } else if ($card['card_condition'] == 5) {
            echo 'HP';
        } else if ($card['card_condition'] == 6) {
            echo 'D';
        }
        echo '</td></tr><tr><td>Description:</td></tr><tr><td colspan="2">'.$card['description'].'</td></tr>';
        echo '</td></tr><tr><td>Quantity:</td><td>'.$card['quantity'];
        echo '</td></tr><tr><td>';
        echo '<form name="add-to-cart" action="/card/add_to_cart.php" method="post">';
        echo '<input type="hidden" name="id" value="'.$card_id.'"/>';
        echo '<input type="text" name="quan_ordered" value="1"/>';
        echo '<input type="hidden" name="quan_left" value="'.$card['quantity'].'"/></td><td>';
        echo '<input type="submit" name="submit_order" value="Add to Cart"/>';
        echo '</td></tr></form></table>';
    } else {
        
    }
?>
</body></html>