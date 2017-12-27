<?php
    require ('../../../open_user_connection.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Checkout - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_shop.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>
    </head>
    <body>
        <h1>Checkout</h1>

    <?php echo '<div id ="payment"><div id="pay-now-button"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="cardoverflowtcg@gmail.com">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency_code" value="USD">';
        
        echo 'Email Address: <input type="text" name="email" required><br/>
        First Name: <input type="text" name="first_name" required><br/>
        Last Name: <input type="text" name="last_name" required><br/>
        Address Line 1: <input type="text" name="address1" required><br/>
        Address Line 2: <input type="text" name="address2"><br/>
        City:</br> <input type="text" name="city" required><br/>
        State:</br> <input type="text" name="state" required><br/>
        ZIP:</br> <input type="text" name="zip" required><br/>
        ';
        
        
        $counter = 1;
        $statement = $db->prepare('SELECT * FROM `discountcodes`');
        $type = '';
        $value ='';
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                if ($row['code'] == $_SESSION["code"] && $row['active'] == 1) {
                    $type = $row['type'];
                    $value = $row['value'];
                }
            }
        }
        
        foreach ($_SESSION['cart'] as $item) {
            $id = $item['id'];
            $quantity = $item['quantity'];
            
            $query = 'SELECT * FROM `cards` WHERE `id`=:id';
            $query_parameters = array ( ':id' => $id );
            
            $statement = $db->prepare($query);
            $statement->execute($query_parameters);
            
            $card = array ();
            
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $card = $row;
            }

            for ($i = 0; $i < $quantity; $i++) {
                echo '<input type="hidden" name="item_name_'.$counter.'" value="'.$card['name'].' - '.$card['edition'].' - '.$card['card_condition'].'">';
                echo '<input type="hidden" name="amount_'.$counter.'" value="'.$card['price'].'">';
                echo '<input type="hidden" name="item_number_'.$counter.'" value="'.$id.'">';
                if($type == "Percent"){
                    echo '<input type="hidden" name="discount_rate_'.$counter.'" value="'.$value.'">';
                }
                ++$counter;
            }
        }
        if($type == "Flat_Rate"){
            echo '<input type="hidden" name="discount_amount" value="'.$value.'">';
            echo '<input type="hidden" name="discount_num" value="'.$quantity.'">';
        }
        echo '<input type="hidden" name="shipping_1" value="1">
             <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" name="address_override" alt="PayPal"></div>   
             </form></div>';
?>
<?php require '../../../resources/top_bar.php';
      require '../../../resources/footer.php';?>
</body></html>