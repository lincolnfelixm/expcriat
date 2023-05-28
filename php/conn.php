<?php
    $servername = "progwb";
    $username = "root";
    $password = "password";
    $dbname = "my_database";

    function log_message($message) {
        $log_file = "database_log.txt";
        $timestamp = date("Y-m-d H:i:s");
        $formatted_message = "[" . $timestamp . "] " . $message . PHP_EOL;

        file_put_contents($log_file, $formatted_message, FILE_APPEND);
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        log_message("Connected to database successfully!"); // Log the message instead of echoing it
    }
?>
