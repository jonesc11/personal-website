<?php
    require ("../open_user_connection.php");
    
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        
        if (!filter_var($email, FILTER_VALITATE_EMAIL)) {
            $query = "SELECT * FROM `users` WHERE `permissions`=1";
            
            $mail_subject = 'New comment on Card Overflow';
            $mail_message = 'Name: '.$name.'\n';
            $mail_message.= 'Email: '.$email.'\n';
            $mail_message.= 'Comment: '.$comment.'\n';
            
            $mail_headers = 'MIME-Version: 1.0' . "\r\n";
            $mail_headers .= 'Content-type: text/tml; charset=iso-8859-1' . "\r\n";
            $mail_headers .= 'From: no_reply@cardoverflow.com\r\n' . 'Reply-to: no_reply@cardoverflow.com\r\nX-Mailer: PHP/' . phpversion();
            
            $statement = $db->prepare($query);
            
            if ($statement->execute()) {
                while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    if (!mail ($row['email'], $mail_subject, $mail_message, $mail_headers)) {
                        echo '<script>';
                        echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                        echo 'window.location = "/contact";';
                        echo '</script>';
                    }
                }
            } else {
                echo '<script>';
                echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
                echo 'window.location = "/contact";';
                echo '</script>';
            }
        } else {
            echo '<script> ';
            echo 'alert("An error occurred. Please contact collindjones.653@gmail.com");';
            echo 'window.location = "/contact";';
            echo '</script>';
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_home.css"/>
        <link rel="stylesheet" href="/resources/styles/style_contact.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <script src="resources/js/jquery-3.2.1.min.js"></script>
        <!--<script type="text/javascript" src="resources/js/slide.js"></script>-->
        <script type="text/javascript" src="/resources/js/search_blur.js"></script>

    </head>
    <body>
        <?php require '../resources/top_bar.php';
              require '../resources/footer.php'; $db = null;?>
            <form id="search-form" action="/search.php" method="post">
              <input type="text" id = "Search" name="search" value="Search..." 
              onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
              <select id="flags" name="flags">
                <option name ="All" value= "All">ALL</option>
                <option name ="English" value = "1">ENGLISH</option>
                <option name ="German" value= "2">GERMAN</option>
                <option name ="French" value = "3">FRENCH</option>
                <option name ="Italian" value = "4">ITALIAN</option>
                <option name ="Spanish" value = "5">SPANISH</option>
                <option name ="Portuguese" value = "6">PORTUGUESE </option>
              </select>
              <input type="submit" name="submit" value="Search"/>
            </form>
            <div id = "contact">
                <h1>Contact Us</h1>
                <form name="contact_form" action="" method="post">
                    Name: </br><input type="text" name="name" required/><br/>
                    </br>Email: </br><input type="text" name="email" required/><br/>
                    </br>Comment: </br><textarea name="comment" rows = "3"required></textarea><br/>
                    <input type="submit" name="submit" value="Submit"/>
                </form>
            </div>
    </body>
</html>
