<?php
    require("../../../open_user_connection.php");
    
    $code_id = $_POST['code_id'];
    
    if (isset($_POST['submit_code'])) {
        $code = $_POST['code'];
        $code = trim(strtoupper($code));
        $query = 'UPDATE `discountcodes` SET `code`=:code WHERE `id`=:id';
        $query_parameters = array ( ':code' => $code,
                                    ':id' => $code_id );
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_type'])) {
        $code_id = $_POST['code_id'];
        $type = $_POST['type'];

        $query = 'UPDATE `discountcodes` SET `type`=:type WHERE `id`=:id';
        $query_parameters = array ( ':type' => $type,
                                    ':id' => $code_id);
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    if (isset($_POST['submit_value'])) {
        $code_id = $_POST['code_id'];
        $value = $_POST['value'];
        
        if (is_numeric($value)) {
            $query = 'UPDATE `discountcodes` SET `value`=:value WHERE `id`=:id';
            $query_parameters = array ( ':value' => $value,
                                        ':id' => $code_id );
            
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        } else {
            echo '<script>';
            echo 'alert("Value must be numeric.");';
            echo 'window.location = "/account/admin/code-edit?id='.$code_id.'";';
            echo '</script>';
        }
    }
    
    if (isset($_POST['submit_enable'])) {
        $code_id = $_POST['code_id'];
        $enable = $_POST['enable'];
        
        $query = 'UPDATE `discountcodes` SET `active`=:active WHERE `id`=:id';
        $query_parameters = array ( ':active' => $enable,
                                    ':id' => $code_id);
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
    }
    
    $db = null;
    header("Location: /account/admin/code-edit?id=".$code_id);
?>