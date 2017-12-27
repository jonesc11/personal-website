<?php
    require '../../open_user_connection.php';
    
    if(!empty($_SESSION['user'])) {
        header("Location: ../");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <link rel="stylesheet" href="../../resources/styles/login_style.css" type="text/css" />
        <link rel="stylesheet" href="/resources/styles/header_style.css"/>
        <link rel="stylesheet" href="/resources/styles/footer_style.css"/>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <title>Login - Card Overflow</title>
    </head>
    <body>
        <?php require '../../resources/top_bar.php';
        require '../../resources/footer.php'; $db = null;?>
        <div id = "container">
            <form action="../../login.php" method="post">
                <h1>
                    Login
                </h1>
                <h2>
                    Email Address<br /><input type="text" name="email" maxlength=50 required /><br /><br />
                    Password<br /><input type="password" name="password" required /><br /><br /><br />
                    <input type="submit" value="Submit"/>
                </h2>
            </form>
        </div>
    </body>
</html>