<?php
    // DB variables set to required settings
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'mgs_user';
    $password = 'pa55word';

    // Try DBO connection
    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        // Display error message
        $error_message = $e->getMessage();
        include('error.html');
        exit();
    }
?>