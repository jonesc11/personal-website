<?php
    require("../../../../open_user_connection.php");
    
    $continue = true;

    $code = '';
    $type = '';
    $value = '';


    if (isset($_POST['submit_create'])) {
        $code = $_POST['code'];
        $type = $_POST['type'];
        $value = $_POST['value'];
        $enable = 1;
    }
    
    $code = trim(strtoupper($code));

    // Default to sorting by name
    $statement = $db->prepare('SELECT `code` FROM `discountcodes`');
    
    if ($statement->execute()) {
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if ($row['code'] == $code && $continue) {
            echo '<script>';
            echo 'alert("Code  already exists.");';
            echo 'window.location = "/account/admin/update-codes/create-code";';
            echo '</script>';
            $continue = false;
        }

        }
    }
    
    if ($continue && !is_numeric($value)) {
        echo '<script>';
        echo 'alert("Price is not a numeric value.");';
        echo 'window.location = "/account/admin/update-codes/create-code";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue && $type == "Percent" && ($value > 100 || $value <= 0)) {
        echo '<script>';
        echo 'alert("Value is not a valid percentage.");';
        echo 'window.location = "/account/admin/update-codes/create-code";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue && $type == "Flat_Rate" && $value <= 0) {
        echo '<script>';
        echo 'alert("Value must be greater than 0.");';
        echo 'window.location = "/account/admin/update-codes/create-code";';
        echo '</script>';
        $continue = false;
    }
    
    if ($continue) {
        $query = 'INSERT INTO discountcodes (code,type,value,active) VALUES (:code, :type, :value, :active)';
        
        $query_parameters = array ( ':code'        => $code,
                                    ':type'      => $type,
                                    ':value'     => $value,
                                    ':active'       => $enable);
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
        
        $last_id = $db->lastInsertId();
        
        header("Location: /account/admin/code-edit?id=".$last_id);
    }
?>