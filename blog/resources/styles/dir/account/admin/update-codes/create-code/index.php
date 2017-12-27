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
        <title>Add Code - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Create a New Code</h1>
        <p>
            A few things to note before creating a new code:
            <ul>
                <li>Do not put a dollar sign in front of the value.</li>
                <li>Percent discounts must have value range from 0 to 100</li>
                <li>Flat Rate discounts must have 2 decimal places without the dollar sign in front</li>
            </ul>
        </p>
        
        <form name="create_code" method="post" enctype="multipart/form-data" action="create-handler.php">
            Code: <input type="text" name="code" required/><br/>
            Type: <select name="type">
                <option value="Percent">Percent</option>
                <option value="Flat_Rate">Flat Rate</option>
            </select><br/>
            Value: <input type="text" name="value" required/><br/>
            <input type="submit" name="submit_create" value="Create code"/>
        </form>
        <a href="../" title="Return to current codes">Return to current codes.</a>
    </body>
</html>