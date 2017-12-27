<?php
    require("../../open_user_connection.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <?php require '../../resources/top_bar.php';
          require '../../resources/footer.php';?>
<html>
    <head>
        <title>Cart - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_shop.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>
        
        <h1>View Cart</h1>
        
        <table id="cartitem">
        <?php
            $counter = 0;
            $totalprice = 0;
            $statement = $db->prepare('SELECT * FROM `discountcodes`');
            $accepted = 0;
            if ($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if ($row['code'] == $_SESSION['code'] && $row['active'] == 1) {
                        $accepted = 1;
                    }
                }
            }
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) != 0) {
                foreach ($_SESSION['cart'] as $item) {
                    $counter = $counter + 1;
                    $quan_ordered = filter_var($item['quantity'], FILTER_SANITIZE_STRING);
                    $id = filter_var($item['id'], FILTER_SANITIZE_STRING);
                    
                    $query = "SELECT * FROM `cards` WHERE `id`=:id";
                    $query_parameters = array ( ':id' => $id );
                    
                    $statement = $db->prepare($query);
                    $statement->execute($query_parameters);
                    
                    $card = array();
                    
                    if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        $card = $row;
                    }
                    
                    echo '<tr>';
                    echo '<td><a href="/card?id='.$id.'" title="View card"><img src="/resources/images/card-images/'.$card['img_lnk'].'" alt="No image found." height="338px" width="255px"/></a></td><td>';
                    echo '<a href="/card?id='.$id.'" title="View card">'.$card['name'];/*.'</h2></a><p>Edition: ';
                    if ($card['edition'] == 1) {
                        echo 'First';
                    } else if ($card['edition'] == 2) {
                        echo 'Unlimited';
                    } else if ($card['edition'] == 3) {
                        echo 'Limited';
                    }
                    echo '<br/>Rarity: ';
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
                    echo '<br/>Condition: ';
                    if ($card['condition'] == 1) {
                        echo 'NM';
                    } else if ($card['condition'] == 2) {
                        echo 'VLP';
                    } else if ($card['condition'] == 3) {
                        echo 'LP';
                    } else if ($card['condition'] == 4) {
                        echo 'MP';
                    } else if ($card['condition'] == 5) {
                        echo 'HP';
                    } else if ($card['condition'] == 6) {
                        echo 'D';
                    }
                    echo '<br/>Language: ';
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
                    echo '</p></td>';*/
                    $totalprice += $card['price'];
                    echo '<td><strong>$'.$card['price'].'</strong><br/></td><td>';
                    echo 'Quantity: '.$quan_ordered.'<br/>';
                    echo '<form name="remove" action="../../remove_from_cart.php" method="post">';
                    echo '<input type="submit" value="Remove from Cart" name="remove"/>';
                    echo '<input type="hidden" value="'.$id.'" name="id"/></form>';
                    echo '</td>';
                    echo '</tr>';
                }
                    if (isset($_POST["code_submit"])){
                        echo '<script>';
                        if($_POST["discount"] == $_SESSION["code"] && $accepted == 1){
                            echo 'alert("This code has already been entered.");';
                        }
                        else{
                            $statement = $db->prepare('SELECT * FROM `discountcodes`');
                            if ($statement->execute()) {
                                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['code'] == $_SESSION["code"] && $row['active'] ==1) {
                                        echo 'alert("Only one discount per order. Your previous code has been removed.");';
                                    }
                                }
                            }
                            $_SESSION["code"] =  trim(strtoupper(htmlspecialchars($_POST['discount'])));
                            $statement = $db->prepare('SELECT * FROM `discountcodes`');
                            $codefound = 0;
                            if ($statement->execute()) {
                                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['code'] == $_SESSION["code"] && $row['active'] == 1) {
                                        if($row['type'] == "Percent"){
                                        echo 'alert("Your code has been accepted.");';
                                        $codefound = 1;
                                        }
                                        else{
                                            if($row['value'] < $totalprice){                                                                                
                                                echo 'alert("Your code has been accepted.");';
                                                $codefound = 1;
                                            }
                                        }
                                    }
                                }
                            }
                            if($codefound == 0){
                                echo 'alert("This is an invalid code")';
                            }
                        }
                        echo '</script>';
                    }
                    echo '</table>';
                    echo '<form method="POST" action="#"';
                    echo '<div id="discount_code">Discount Code <input type="text" name="discount">';
                    echo '<input type="submit" id="code_submit" name="code_submit" value="Submit"/> </div>';
                    echo '</form>';
                    echo '<div id="checkout"><a href="checkout" title="Checkout">Proceed to Checkout</a></div>';
                
            } else {
                echo '<div id="noitem"><h1>There are no items in your cart.</h1>';
                echo '<br>Click <a href="/shop">here</a> to be taken to the shop</div>';
                echo '</table>';
            }
            
            
        ?>
        
    </body>
</html>