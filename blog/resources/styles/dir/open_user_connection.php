<?php
    $username = 'coverflowaccess';
    $password = 'Ak47br123!';
    $host = 'localhost';
    $dbname = 'cardoverflowmain';
    
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try {
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    } catch(PDOException $exception) {
        die('[ERROR] Could not connect to the database. If you are seeing this error, please contact collindjones.653@gmail.com');
    }
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
    
    header('Content-Type: text/html; charset=utf-8');
    
    session_start();