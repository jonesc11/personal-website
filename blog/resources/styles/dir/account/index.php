<?php
    require '../open_user_connection.php';
    ?>
<?php
    
    if (empty($_SESSION['user'])) {
        header("Location: /account/login");
        die("Redirecting...");
    }
    
    if ($_SESSION['user']['active'] == 0) {
        header("Location: /account/login");
    }
    
    if ($_SESSION['user']['permissions'] == 1) {
        header("Location: /account/admin");
        die("Redirecting...");
    }
    
    require '../resources/top_bar.php';
    require '../resources/footer.php';
    
    if (isset($_POST['submit_change_email'])) {
        $continue = true;
        
        $id_to_change = $_POST['uid'];
        $change_email_to = $_POST['new_email'];
        $old_email = "";
        
        $query = "SELECT * FROM `users` WHERE `id`=:id";
        $query_parameters = array ( ':id' => $id_to_change );
        
        $statement = $db->prepare($query);
        $statement->execute($query_parameters);
        
        if ($row = $statement->fetch()) {
            $old_email = $row['email'];
        } else {
            die("An error occurred. Please contact collindjones.653@gmail.com");
        }
        
        if (!filter_var($change_email_to, FILTER_VALIDATE_EMAIL)) {
            echo '<script>';
            echo 'alert("Please enter a valid email address.");';
            echo 'window.location = "/account";';
            echo '</script>';
            
            $continue = false;
        }
        
        if ($continue && $change_email_to == $old_email) {
            echo '<script>';
            echo 'alert("That is your current email address. Please use a different address.");';
            echo 'window.location = "/account"';
            echo '</script>';
            
            $continue = false;
        }
        
        $query = "SELECT * FROM `users` WHERE email=:email";
        $query_parameters = array ( ':email' => $change_email_to );
        
        $statement = $db->prepare($query);
        $statement->execute($query_parameters);
        
        if ($row = $statement->fetch() && $continue) {
            echo '<script>';
            echo 'alert("This email address is already in use. Please use a different address.");';
            echo 'window.location = "/account"';
            echo '</script>';
            
            $continue = false;
        }
        
        if ($continue) {
            $query = "UPDATE `users` SET email=:email WHERE id=:id";
            $query_parameters = array ( ':email' => $change_email_to,
                                        ':id'    => $id_to_change );
            
            $statement = $db->prepare($query);
            $statement->execute($query_parameters);
            
            $mail_from = 'no_reply@cardoverflow.com';
            $mail_subject = 'Card Overflow Changed Email';
            
            $mail_headers = 'MIME-Version: 1.0' . "\r\n";
            $mail_headers .= 'Content-type: text/tml; charset=iso-8859-1' . "\r\n";
            $mail_headers .= 'From: ' . $mail_from . '\r\n' . 'Reply-to: collindjones.653@gmail.com\r\nX-Mailer: PHP/' . phpversion();
            
            $mail_message =  "Your Card Overflow account has been updated!\nYou have changed your email address from this address to ".$change_email_to.".\n";
            $mail_message .= "If this was not you, please submit a ticket at our website.\n\n";
            $mail_message .= "See you around!\n - The Card Overflow Team";
            
            if (!mail($old_email, $mail_subject, $message, $headers)) {
                echo '<script>';
                echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/account"';
                echo '</script>';
            }
            
            $mail_from = 'no_reply@cardoverflow.com';
            $mail_subject = 'Card Overflow Changed Email';
            
            $mail_headers = 'MIME-Version: 1.0' . "\r\n";
            $mail_headers .= 'Content-type: text/tml; charset=iso-8859-1' . "\r\n";
            $mail_headers .= 'From: ' . $mail_from . '\r\n' . 'Reply-to: collindjones.653@gmail.com\r\nX-Mailer: PHP/' . phpversion();
            
            $mail_message =  "Your Card Overflow account has been updated!\n";
            $mail_message .= "You have changed your email address from ".$old_email." to this address.\n";
            $mail_message .= "If this was not you, please submit a support ticket.\n\n";
            $mail_message .= "See you around!\n - The Card Overflow Team";
            
            if (!mail($change_email_to, $mail_subject, $message, $headers)) {
                echo '<script>';
                echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/account"';
                echo '</script>';
            }
            
            echo '<script>window.location = "/account/change-email-success";</script>';
        }
    }
    
    if (isset($_POST['submit_pw_change'])) {
        $old_pw = $_POST['old_pw'];
        $new_pw = $_POST['new_pw'];
        $conf_new_pw = $_POST['conf_new_pw'];
        $email = "";
        $hashed_old = '';
        $hashed_new = '';
        
        $continue = true;
        
        $query = "SELECT * FROM `users` WHERE id=:id";
        $query_parameters = array ( ':id' => $_POST['uid'] );
        
        $statement = $db->prepare($query);
        $statement->execute($query_parameters);
        
        $salt = '';
        
        if ($row = $statement->fetch()) {
            $hashed_old = $row['password'];
            $salt = $row['salt'];
            
            $email = $row['email'];
            
            $password = hash('sha256', $old_pw . $salt);
            
            for ($i = 0; $i < 74815; $i++) {
                $password = hash('sha256', $password . $salt);
            }
            
            $hashed_new = hash('sha256', $new_pw . $salt);
            
            for ($i = 0; $i < 74815; $i++) {
                $hashed_new = hash('sha256', $hashed_new . $salt);
            }
            
            if ($password != $hashed_old) {
                echo '<script>';
                echo 'alert("The password you entered is incorrect. Please try again.");';
                echo 'window.location = "/account"';
                echo '</script>';
                
                $continue = false;
            }
        } else {
            echo '<script>';
            echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
            echo 'window.location = "/account";';
            echo '</script>';
            
            $continue = false;
        }
        
        if ($new_pw != $conf_new_pw && $continue) {
            echo '<script>';
            echo 'alert("New passwords do not match. Please try again.");';
            echo 'window.location = "/account";';
            echo '</script>';
            
            $continue = false;
        }
        
        if ($hashed_new == $hashed_old && $continue) {
            echo '<script>';
            echo 'alert("Your new password must be different from your old password. Please try again.");';
            echo 'window.location = "/account"';
            echo '</script>';
            
            $continue = false;
        }
        
        if (!(preg_match('~[A-Z]~', $new_pw) && 
              preg_match('~[a-z]~', $new_pw) &&
              preg_match('~[0-9]~', $new_pw)
              ) && $continue) {
            echo '<script>';
            echo 'alert("Password must contain at least one number, at least one lowercase character, and at least one uppercase character and be at least 8 characters long.");';
            echo 'window.location = "/account";';
            echo '</script>';
            
            $continue = false;
        }
        
        if ($continue) {
            $query = "UPDATE `users` SET `password`=:password WHERE `id`=:id";
            $query_parameters = array ( ':password' => $hashed_new,
                                        ':id'       => $_POST['uid'] );
            
            $statement = $db->prepare($query);
            $statement->execute($query_parameters);
            
            $mail_from = 'no_reply@cardoverflow.com';
            $mail_subject = 'Card Overflow Changed Email';
            
            $mail_headers = 'MIME-Version: 1.0' . "\r\n";
            $mail_headers .= 'Content-type: text/tml; charset=iso-8859-1' . "\r\n";
            $mail_headers .= 'From: ' . $mail_from . '\r\n' . 'Reply-to: collindjones.653@gmail.com\r\nX-Mailer: PHP/' . phpversion();
            
            $mail_message =  "Your Card Overflow account has been updated!\n";
            $mail_message .= "You have changed your Card Overflow password.\n";
            $mail_message .= "If this was not you, please submit a support ticket.\n\n";
            $mail_message .= "See you around!\n - The Card Overflow Team";
            
            if (!mail($email, $mail_subject, $message, $headers)) {
                echo '<script>';
                echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/account"';
                echo '</script>';
            }
            
            echo '<script>window.location = "/account/change-password-success";</script>';
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Account - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_account.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <?php
            $admins = array();
            
            echo '<div id = "container"><h1>Welcome, '.$_SESSION['user']['firstname'].'!<br /></h1>';
            
            $email = $_SESSION['user']['email'];
            echo '<h2>Account Details:</h2>';
            echo 'Current Email Address: '.$_SESSION['user']['email'];
            echo '<br/>Change email address to: <form name="change_email" method="post"><input type="hidden" name="uid" value="'.$_SESSION['user']['id'].'"/>';
            echo '<input type="text" name="new_email"/><input type="submit" name="submit_change_email" value="Submit"/></form>';
            echo '<h2>Change Password: </h2><form name="change_password" method="post">';
            echo '<input type="hidden" name="uid" value="'.$_SESSION['user']['id'].'"/>';
            echo 'Current Password: </br><input type="password" name="old_pw"/><br /><br />';
            echo 'New Password: </br><input type="password" name="new_pw"/><br /><br />';
            echo 'Confirm Password:</br> <input type="password" name="conf_new_pw"/><br /><br />';
            echo '<input type="submit" name="submit_pw_change" value="Change Password"/></form>';
            echo 'Thank You For making an Account. New Features will be added soon!</h2></div>'
        ?>
    </body>
</html>