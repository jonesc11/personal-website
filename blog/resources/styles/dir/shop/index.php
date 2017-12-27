<?php
    require("../open_user_connection.php");
    
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Shop - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_shop.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>
        <?php require '../resources/top_bar.php';
            require '../resources/footer.php';?>
        <form id="search-form" action="/search.php" method="post">
          <input type="text" id = "Search" name="search" value="Search..." 
          onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
          <select id="flags" name="flags">
                <option name ="All" value= "All">ALL</option>
                <option name ="English" value = "1">ENGLISH</option>
                <option name ="German" value= "2">GERMAN</option>
                <option name ="French" value = "3">FRENCH</option>
                <option name ="Italian" value = "4">ITALIAN</option>
                <option name ="Spanish" value = "5">SPANISH</option>
                <option name ="Portuguese" value = "6">PORTUGUESE </option>
          </select>
          <input type="submit" name="submit" value="Search"/>
        </form>
        <?php
            $cards = array();
            
            $query = '';
            
            if (isset($_GET['q'])) {
                if(isset($_GET['f'])){
                    $filt = filter_var($_GET['f'], FILTER_SANITIZE_SPECIAL_CHARS);
                    if($filt == "All"){
                        $searchq = filter_var($_GET['q'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $query = "SELECT * FROM cards WHERE `quantity`!=0 AND `name` LIKE '%{$searchq}%' ORDER BY `name`";
                    }
                    else{
                        $searchq = filter_var($_GET['q'], FILTER_SANITIZE_SPECIAL_CHARS);
                        $query = "SELECT * FROM cards WHERE `quantity`!=0 AND name LIKE '%{$searchq}%' AND language = '{$filt}' ORDER BY `name`";
                    }
                }
                else{
                     $searchq = filter_var($_GET['q'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $query = "SELECT * FROM cards WHERE `quantity`!=0 AND name LIKE '%{$searchq}%' ORDER BY `name`";   
                }
            } else {
                $query = 'SELECT * FROM `cards` WHERE `quantity`!=0 ORDER BY `name`';
            }
            
            $statement = $db->prepare($query);
            
            if($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    array_push($cards, $row);
                }
            }
            echo '<table id="card-list">';
            echo '<tr>';
            if (sizeof($cards) != 0) {
                $count = 0;
                foreach ($cards as $card) {
                    if($count == 3){
                        $count = 0;
                        echo '</tr><tr>';
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

                    echo '<td><div id="card-object">';
                    echo '<a href="/card/?id='.$id.'" title="View card"><img height="338px" width="255px" src="'.$imgLink.'" alt="No image found"/></a>';
                    echo '<h2><a href="/card/?id='.$id.'" title="View card">'.$name.'</a></h2><p>';
                    
                    echo 'Language: ';
                    
                    if ($language == 1) {
                        echo 'English';
                    } else if ($language == 2) {
                        echo 'German';
                    } else if ($language == 3) {
                        echo 'French';
                    } else if ($language == 4) {
                        echo 'Italian';
                    } else if ($language == 5) {
                        echo 'Spanish';
                    } else if ($language == 6) {
                        echo 'Portuguese';
                    }
                    echo '<br/>Rarity: ';
                    
                    if ($rarity == 1) {
                        echo 'Common';
                    } else if ($rarity == 2) {
                        echo 'Rare';
                    } else if ($rarity == 3) {
                        echo 'Super Rare';
                    } else if ($rarity == 4) {
                        echo 'Ultra Rare';
                    } else if ($rarity == 5) {
                        echo 'Ultimate Rare';
                    } else if ($rarity == 6) {
                        echo 'Secret Rare';
                    } else if ($rarity == 7) {
                        echo 'Ghost Rare';
                    } else if ($rarity == 8) {
                        echo 'Gold Rare';
                    } else if ($rarity == 9) {
                        echo 'Platinum Rare';
                    } else if ($rarity == 10) {
                        echo 'Duelist League';
                    } else {
                        echo 'Unknown';
                    }
                    
                    echo '<br/>Edition: ';
                    if ($edition == 1) {
                        echo 'First';
                    } else if ($edition == 2) {
                        echo 'Unlimited';
                    } else if ($edition == 3) {
                        echo 'Limited';
                    }
                    
                    echo '<br/>Condition: ';
                    if ($condition == 1) {
                        echo 'NM';
                    } else if ($condition == 2) {
                        echo 'VLP';
                    } else if ($condition == 3) {
                        echo 'LP';
                    } else if ($condition == 4) {
                        echo 'MP';
                    } else if ($condition == 5) {
                        echo 'HP';
                    } else if ($condition == 6) {
                        echo 'D';
                    }
                    
                    echo '</p></a>';
                    
                    echo '<strong>$'.$price.'</strong><br/>';
                    echo '<form method="post" name="order_card" action="../add_to_cart.php"><input type="text" id="quan_ordering" name="quan_ordered" value="1"/>';
                    echo '<input type="hidden" name="quan_left" value="'.$quantity.'"/><input type="hidden" name="id" value="'.$id.'"';
                    echo '</br><input type="submit" id="add_to_cart" name="submit_order" value="Add to cart"/></form>';
                    if($quantity != 1){
                        echo '<br/>'.$quantity.' cards left.';
                    } else {
                        echo '<br/>'.$quantity.' card left.';
                    }
                    echo '</td>';
                    ++$count;
                }
            } else {
                echo "<tr><td colspan=\"3\">No cards found.</td></tr>";
            }
            while($count != 3){
                echo '<td></td>';
                ++$count;
            }
            echo '</tr>';
            echo "</table>";
        ?>
    </body>
</html>