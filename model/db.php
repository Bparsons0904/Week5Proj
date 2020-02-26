<?php
    // DB variables set to required settings
    $dsn = 'mysql:host=localhost;dbname=todolist';
    $username = 'root';

    // Try DBO connection
    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        // Display error message
        $error_message = $e->getMessage();
        include('./errors/database_error.php');
        exit();
    }
?>