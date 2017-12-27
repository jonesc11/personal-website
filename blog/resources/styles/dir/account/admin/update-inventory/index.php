<?php
    require("../../../open_user_connection.php");
    
    $sort = 'name';
    
    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
    }
    
    if (isset($_POST['sort_order']) && $_POST['sort_order'] != $sort) {
        echo '<script>window.location = "/account/admin/update-inventory/?sort='.$_POST['sort_order'].'";</script>';
    }
?>
<html>
    <head>
        <title>Edit Inventory - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_inventory.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Current Inventory:</h1>
        <p>Sort by: </p><form name="sorting" method="post" action="">
            <select name="sort_order" onchange="document.sorting.submit();">
        <?php
            if ($sort == 'edition') {
                echo '<option value="name">Name</option>';
                echo '<option value="edition" selected>Edition</option>';
                echo '<option value="rarity">Rarity</option>';
                echo '<option value="price">Price</option>';
                echo '<option value="sold">Amount Sold</option>';
                echo '<option value="quantity">Quantity</option>';
            } else if ($sort == 'rarity') {
                echo '<option value="name">Name</option>';
                echo '<option value="edition">Edition</option>';
                echo '<option value="rarity" selected>Rarity</option>';
                echo '<option value="price">Price</option>';
                echo '<option value="sold">Amount Sold</option>';
                echo '<option value="quantity">Quantity</option>';
            } else if ($sort == 'price') {
                echo '<option value="name">Name</option>';
                echo '<option value="edition">Edition</option>';
                echo '<option value="rarity">Rarity</option>';
                echo '<option value="price" selected>Price</option>';
                echo '<option value="sold">Amount Sold</option>';
                echo '<option value="quantity">Quantity</option>';
            } else if ($sort == 'quantity') {
                echo '<option value="name">Name</option>';
                echo '<option value="edition">Edition</option>';
                echo '<option value="rarity">Rarity</option>';
                echo '<option value="price">Price</option>';
                echo '<option value="sold">Amount Sold</option>';
                echo '<option value="quantity" selected>Quantity</option>';
            } else if ($sort == 'sold') {
                echo '<option value="name">Name</option>';
                echo '<option value="edition">Edition</option>';
                echo '<option value="rarity">Rarity</option>';
                echo '<option value="price">Price</option>';
                echo '<option value="sold" selected>Amount Sold</option>';
                echo '<option value="quantity">Quantity</option>';
            } else { // Default to sorting by name
                echo '<option value="name" selected>Name</option>';
                echo '<option value="edition">Edition</option>';
                echo '<option value="rarity">Rarity</option>';
                echo '<option value="price">Price</option>';
                echo '<option value="sold">Amount Sold</option>';
                echo '<option value="quantity">Quantity</option>';
            }
            
            echo '</select></form><a href="/account/admin/update-inventory/create-card" title="Create new card">Create a new card</a>';
            
            // Display as a table
            $cards = array();
            
            if ($sort == 'edition') {
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `edition`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            } else if ($sort == 'rarity') {
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `edition`, `name`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            } else if ($sort == 'price') {
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `price`, `name`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            } else if ($sort == 'quantity') {
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `quantity`, `name`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            } else if ($sort == 'sold') {
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `num_sold`, `name`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            } else { // Default to sorting by name
                $statement = $db->prepare('SELECT * FROM `cards` ORDER BY `name`');
                
                if ($statement->execute()) {
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                        array_push($cards, $row);
                    }
                }
            }
            
            echo '<h1>Current Cards</h1>';
            echo '<h2>Click on a card to edit its properties.</h2>';
            echo '<table id="display-cards">';
            echo '<tr><th>Name</th><th>Edition</th><th>Rarity</th><th>Condition</th><th>Language</th><th>Price</th><th>Sold</th><th>Quantity</th></tr>';
            
            foreach ($cards as $card) {
                $rarity = $card['rarity'];
                $language = $card['language'];
                $edition = $card['edition'];
                $condition = $card['card_condition'];
                
                echo '<tr>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">'.$card['name'].'</a></td>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">';
                if ($edition == 1) {
                    echo 'First';
                } else if ($edition == 2) {
                    echo 'Unlimited';
                } else if ($edition == 3) {
                    echo 'Limited';
                }
                echo '</a></td>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">';
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
                echo '</a></td>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">';
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
                echo '</a></td>';
                
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">';
                
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
                
                echo '</a></td>';
                
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">'.$card['price'].'</a></td>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">'.$card['num_sold'].'</a></td>';
                echo '<td><a href="/card/edit?id='.$card['id'].'" title="View card">'.$card['quantity'].'</a></td>';
                echo '</tr>';
            }
            echo '<tr><td><a href=/account/admin/>Back</a></tr></td>';
            echo '</table>';
        ?>
    </body>
</html>