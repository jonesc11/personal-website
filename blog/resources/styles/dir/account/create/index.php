<?php
    require("../../open_user_connection.php");
    
    $continue = true;
    
    if(!empty($_SESSION['user'])) {
        header("Location: /account");
    }
    
    if(!empty($_POST) && $continue) {
        if((!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !filter_var($_POST['conf_email'], FILTER_VALIDATE_EMAIL)) && $continue) {
            echo '<script>';
            echo 'alert("Please enter a valid email address.");';
            echo 'window.location = "/account/create"';
            echo '</script>';
            $continue = false;
        }
        
        $query = 'SELECT * FROM users WHERE email = :email;';
        $query_parameters = array(':email' => strtolower($_POST['email']));
        
        try {
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        } catch (PDOException $exception) {
            echo '<script>';
            echo 'alert("There was an error completing the query. Please contact collindjones.653@gmail.com.");';
            echo 'window.location = "/account/create"';
            echo '</script>';
        }
        
        $row = $statement->fetch();
        
        if ($row && $continue) {
            echo '<script>';
            echo 'alert("Email already in use. Please use a different email.");';
            echo 'window.location = "/account/create"';
            echo '</script>';
            $continue = false;
        }
        
        if (strtolower($_POST['email']) != strtolower($_POST['conf_email']) && $continue) {
            echo '<script>';
            echo 'alert("Emails do not match. Please try again.");';
            echo 'window.location = "/account/create"';
            echo '</script>';
            $continue = false;
        }
        
        if ($_POST['password'] != $_POST['conf_password'] && $continue) {
            echo '<script>';
            echo 'alert("Passwords do not match. Please try again.");';
            echo 'window.location = "/account/create"';
            echo '</script>';
            $continue = false;
        }
        
        if (!(preg_match('~[A-Z]~', $_POST['password']) && 
              preg_match('~[a-z]~', $_POST['password']) &&
              preg_match('~[0-9]~', $_POST['password'])
              ) && $continue) {
            echo '<script>';
            echo 'alert("Password must contain at least one number, at least one lowercase character, and at least one uppercase character and be at least 8 characters long.");';
            echo 'window.location = "/account/create";';
            echo '</script>';
            $continue = false;
        }
        
        if ($continue) {
            $query = "INSERT INTO users (firstname, lastname, email, password, salt) VALUES (:firstname, :lastname, :email, :password, :salt)";
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
            $password = hash('sha256', $_POST['password'] . $salt);
            
            for ($i = 0; $i < 74815; $i++) {
                $password = hash('sha256', $password . $salt);
            }
            
            $query_parameters = array( ':firstname' => $_POST['firstname'],
                                       ':lastname' => $_POST['lastname'],
                                       ':email' => strtolower($_POST['email']),
                                       ':password' => $password,
                                       ':salt' => $salt);
            
            try {
                $statement = $db->prepare($query);
                $result = $statement->execute($query_parameters);
            } catch (PDOException $exception) {
                echo '<script>';
                echo 'alert("Error posting to the database. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/account/create"';
                echo '</script>';
            }
            
            $mail_from = 'no_reply@cardoverflow.com';
            $mail_subject = 'Welcome to Card Overflow!';
            
            $mail_headers = 'MIME-Version: 1.0' . "\r\n";
            $mail_headers .= 'Content-type: text/tml; charset=iso-8859-1' . "\r\n";
            $mail_headers .= 'From: ' . $mail_from . '\r\n' . 'Reply-to: no_reply@cardoverflow.com\r\nX-Mailer: PHP/' . phpversion();
            
            $mail_message  = "Your Card Overflow account has been created!\n".$_POST['firstname'].", welcome to Card Overflow! To log into your account, click http://cardoverflow.com/account/login.";
            $mail_message .= "\nSee you around!\n - The Card Overflow Team\n\n100 Raritan Avenue,\nHighland Park, NJ, 08904\nUnited States";
            
            if (!mail($_POST['email'], $mail_subject, $mail_message, $mail_headers)) {
                echo '<script>';
                echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/account/create"';
                echo '</script>';
            }
            
            $mail_subject = 'New user registered on Card Overflow';
            
            $mail_message =  "A new user has joined Card Overflow!\n";
            $mail_message .= "Name: ".$_POST['firstname'].' ' . $_POST['lastname'] . "\nEmail Address: " . strtolower($_POST['email']);
            
            $statement = $db->prepare('SELECT * FROM users WHERE permissions=1');
            
            if ($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if (!mail($row['email'], $mail_subject, $mail_message, $headers)) {
                        echo '<script>';
                        echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                        echo 'window.location = "/account/create"';
                        echo '</script>';
                    }
                }
            }
            
            header('Location: success');
        }
        $db = null;
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_create_account.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <?php require '../../resources/top_bar.php';
        require '../../resources/footer.php'; $db = null;?>
        <div id="container">
            <form action="" method="post">
                <h1>
                First Name<br /><input type="text" name="firstname" maxlength=20 required/> 20 char max<br /><br />
                Last Name<br /><input type="text" name="lastname" maxlength=20 required/> 20 char max<br /><br />
                Email<br /><input type="text" name="email" maxlength=50 required/> 50 char max<br /><br />
                Confirm Email<br /><input type="text" name="conf_email" maxlength=50 required/> 50 char max<br /><br />
                Password<br /><input type="password" name="password" required/><br /><br />
                Confirm Password<br /><input type="password" name="conf_password" required/><br /><br />
                <input type="submit" name="submit" value="Submit"/>
            </form>
        </div>
    </body>
</html>