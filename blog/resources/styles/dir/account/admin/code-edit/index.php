<?php
    require("../../../open_user_connection.php");
    
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
        <title>Edit Code - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_code_edit.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Edit Existing Code</h1>
        
        <?php
            $code_id = $_GET['id'];
            
            $query = "SELECT * FROM `discountcodes` WHERE `id`=:id;";
            
            $statement = $db->prepare($query);
            
            $id = $code_id;
            $statement->execute(array(':id' => $id));
            
            $code = array();
            
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $code = $row;
            } else {
                echo 'Code not found.';
            }
            
            $keycode = $code['code'];
            $type = $code['type'];
            $value = $code['value'];
            $enable = $code['active'];
            
            echo '<form name="edit_code" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="code_id" value="'.$id.'">';
            echo 'Code: '.$keycode.'<br/>';
            echo 'Change code to: <input type="text" name="code"/>';
            echo '<input type="submit" value="Change Code" name="submit_code"/><br/></form>';
            echo '<form name="edit_type" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="code_id" value="'.$id.'">';
            echo 'Type: '.$type.'<br/>';
            echo 'Change Type to: <select name="type"/>';
            echo '<option value="Percent">Percent</option>';
            echo '<option value="Flat_Rate">Flat Rate</option>';
            echo '</select>';
            echo '<input type="submit" value="Change Type" name="submit_type"/><br/></form>';
            echo '<form name="edit_value" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="code_id" value="'.$id.'">';
            echo 'Value: '.$value.'<br/>';
            echo 'Change value to: <input type="text" name="value"/>';
            echo '<input type="submit" value="Change Value" name="submit_value"/><br/></form>';
            echo '<form name="edit_enable" action="edit_handler.php" method="post">';
            echo '<input type="hidden" name="code_id" value="'.$id.'">';
            if($enable == 1){
                echo 'Enabled<br/>';
            }
            else{
                echo 'Disabled<br/>';
            }
            echo 'Enable discount code? <select name="enable"/>';
            echo '<option value="1">Yes</option>';
            echo '<option value="0">No</option>';
            echo '</select>';
            echo '<input type="submit" value="Change Enable" name="submit_enable"/><br/></form>';
        ?>
        
        <a href="/account/admin/update-codes" title="Return to current discount codes">Return to current discount codes.</a>
    </body>
</html>