<?php
    require("../../../open_user_connection.php");
?>
<html>
    <head>
        <title>Edit Codes - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_inventory.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <h1>Current Codes:</h1>
        <?php
            echo '</select></form><a href="/account/admin/update-codes/create-code" title="Create new code">Create a new code</a>';
            // Display as a table
            $codes = array();
            // Default to sorting by name
            $statement = $db->prepare('SELECT * FROM `discountcodes` ORDER BY `id`');
            
            if ($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    array_push($codes, $row);
                }
            }

            echo '<h2>Click on a code to edit its properties.</h2>';
            echo '<table id="display-codes">';
            echo '<tr><th>Code</th><th>Type</th><th>Value</th><th>Enabled</th>';
            
            foreach ($codes as $code) {
                $value = $code['value'];
                $type = $code['type'];
                $keycode = $code['code'];
                $enable = $code['active'];
                
                echo '<tr>';
                echo '<td><a href="/account/admin/code-edit?id='.$code['id'].'" title="View code">'.$keycode.'</a></td>';
                echo '<td><a href="/account/admin/code-edit?id='.$code['id'].'" title="View code">';
                if($type == 'Flat_Rate'){
                    echo 'Flat Rate';
                }
                else{
                    echo $type;
                }
                echo '</a></td>';
                echo '<td><a href="/account/admin/code-edit?id='.$code['id'].'" title="View code">';
                echo $value;
                echo '</a></td>';
                echo '<td><a href="/account/admin/code-edit?id='.$code['id'].'" title="View code">';
                if($enable == 1){
                    echo 'Yes';
                }
                else{
                    echo 'No';
                }
                echo '</a></td>';
                echo '</tr>';
            }
            echo '<tr><td><a href=/account/admin/>Back</a></tr></td>';
            echo '</table>';
        ?>
    </body>
</html>