<?php
    require '../../open_user_connection.php';
    
    unset($_SESSION['user']);
    
    $db = null;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <?php require '../../resources/top_bar.php';
        require '../../resources/footer.php'; $db = null;?>
<html>
    <head>
        <title>Account - Card Overflow</title>
        <link rel="stylesheet" href="/resources/styles/style_account.css"/>
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    </head>
    <body>
        <div id = "container_small">
        <p>You have been logged out, and your password has been changed successfully.<br/><br/>
        <a href="/account/login" title="Login">Login here.</a></p>
        </div>
    </body>
</html>