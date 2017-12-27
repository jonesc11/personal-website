<?php
    $user = 'collindjonesblog';
    $pass = 'Jovi2011';
    
    try {
        $db = new PDO('mysql:host=localhost;dbname=collindjones_blog', $user, $pass);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>