<?php
    require "open_user_connection.php";
    
    $continue = true;
    
    if(!empty($_SESSION['user'])) {
        echo '<script>window.location="/account"</script>';
    }
    
    if (!empty($_POST) && $continue) {
        $query = 'SELECT * FROM users WHERE email = :email';
        $query_parameters = array(':email' => strtolower($_POST['email']));
        
        try {
            $statement = $db->prepare($query);
            $result = $statement->execute($query_parameters);
        } catch (PDOException $exception) {
            echo '<script>';
            echo 'alert("There was an error completing the query. Please contact collindjones.653@gmail.com.");';
            echo 'window.location = "/account/login"';
            echo '</script>';
        }
        
        if ($row = $statement->fetch()) {
            $salt = $row['salt'];
            $passhash = $row['password'];
            
            $current_password = hash('sha256', $_POST['password'] . $salt);
            
            for($i = 0; $i < 74815; $i++) {
                $current_password = hash('sha256', $current_password . $salt);
            }
            
            if($passhash !== $current_password || $row['active'] == 0) {
                echo '<script>';
                echo 'alert("Email and password do not match.");';
                echo 'window.location = "/account/login"';
                echo '</script>';
            } else {
                unset($row['password']);
                unset($row['salt']);
                
                $_SESSION['user'] = $row;
                
                echo '<script>window.location = "/account";</script>';
            }
        } else {
            echo '<script>';
            echo 'alert("Email and password do not match.");';
            echo 'window.location = "/account/login"';
            echo '</script>';
        }
    }
    echo 'closed';
    $db = null;
?>