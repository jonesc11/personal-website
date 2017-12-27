<?php
    require("../../../../open_user_connection.php");
    
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
        header("Location: /account");
        $db = null;
        die("Redirecting...");
    }
?>
<html>
    <head>
        <title>Add Card - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_card.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Create a New Card</h1>
        <p>
            A few things to note before creating a new card:
            <ul>
                <li>Type in everything how you wish it to be displayed on the webpage.</li>
                <li>Upload the image as a .png, .jpg, or .gif named without spaces. Name must be unique.</li>
                <li>Do not put a dollar sign in front of the price.</li>
                <li>Image must be less than 500kb.</li>
            </ul>
        </p>
        
        <form name="create_card" method="post" enctype="multipart/form-data" action="create-handler.php">
            Card name: <input type="text" name="name" required/><br/>
            Language: <select name="language">
                <option value="1">English</option>
                <option value="2">German</option>
                <option value="3">French</option>
                <option value="4">Italian</option>
                <option value="5">Spanish</option>
                <option value="6">Portuguese</option>
            </select><br/>
            Rarity: <select name="rarity">
                <option value=1>Common</option>
                <option value=2>Rare</option>
                <option value=3>Super Rare</option>
                <option value=4>Ultra Rare</option>
                <option value=5>Ultimate Rare</option>
                <option value=6>Secret Rare</option>
                <option value=7>Ghost Rare</option>
                <option value=8>Gold Rare</option>
                <option value=9>Platinum Rare</option>
                <option value=10>Duelist League</option>
            </select><br/>
            Edition: <select name="edition">
                <option value=1>First</option>
                <option value=2>Unlimited</option>
                <option value=3>Limited</option>
            </select><br/>
            Price: <input type="text" name="price" required/><br/>
            Condition: <select name="condition">
                <option value=1>NM</option>
                <option value=2>VLP</option>
                <option value=3>LP</option>
                <option value=4>MP</option>
                <option value=5>HP</option>
                <option value=6>D</option>
            </select><br/>
            Description: <textarea maxlength=1500 name="description"></textarea><br/>
            Quantity: <input type="text" name="quantity" required/>
            
            Upload an image: <input type="file" name="image" required/><br/>
            
            <input type="submit" name="submit_create" value="Create card"/>
        </form>
        <a href="../" title="Return to current inventory">Return to current inventory.</a>
    </body>
</html>