<?php
    require("../../open_user_connection.php");
    
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
    
    if (isset($_POST['remove_a'])) {
        $id_to_rem = $_POST['rem_id'];
        
        $statement = $db->prepare('UPDATE users SET permissions=0 WHERE id=:id');
        $query_parameters = array(':id' => $id_to_rem);
        $statement->execute($query_parameters);
        if ($_SESSION['user']['id'] == $id_to_rem) { unset($_SESSION['user']); }
        header ("Location: /account/login");
        $db = null;
    }
    
    if (isset($_POST['submit_admin'])) {
        $email_to_add = $_POST['admin_add_email'];
        
        $query = "SELECT * FROM `users` WHERE `email`=:email";
        $query_parameters = array ( ':email' => $email_to_add );
        
        $statement = $db->prepare($query);
        $result = $statement->execute($query_parameters);
        
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $query = "UPDATE `users` SET `permissions`=1 WHERE `email`=:email";
            $query_parameters = array ( ':email' => $email_to_add );
            
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        } else {
            echo '<script>alert("User with that email address does not exist.");</script>';
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Admin - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_admin.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <?php
            $admins = array();
            
            $statement = $db->prepare('SELECT * FROM users WHERE permissions=1');
            
            if ($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    array_push($admins, $row);
                }
            }
            
            echo 'Welcome, '.$_SESSION['user']['firstname'].'!<br />';
            
            echo '<a href="/account/admin/update-inventory" title="Update Inventory">To update your inventory, click here.</a></br>';
            echo '<a href="/account/admin/update-codes" title="Update Codes">To update your discount codes, click here.</a>';
            
            echo '<h1>Admins ('.sizeof($admins).'):</h1><br /><table id="admins">';
            echo 'To add an admin, enter his/her email address: ';
            echo '<form name="add_admin" method="post"><input type="text" name="admin_add_email"/><input type="submit" name="submit_admin" value="Submit"/></form>';
            foreach ($admins as $admin) {
                echo '<tr><td>'.$admin['firstname'].' '.$admin['lastname'].'</td><td>'.$admin['email'].'</td>';
                echo '<td><form name="remove_admin" method="post"><input type="hidden" name="rem_id" value='.$admin['id'].'/>';
                echo '<input type="submit" name="remove_a" value="Remove admin permission"/></form></td></li>';
            }
            echo '</table>';
        ?>
    </body>
</html>