<?php
    session_start();

    $timeout_duration = 1800; // 30 minutes

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        // Check if the session has expired
        if (time() - $_SESSION["last_activity"] > $timeout_duration) {
            // Session expired, destroy the session and redirect to login page
            session_unset();
            session_destroy();
            header("Location: login.html");
            exit;
        } else {
            // Session still active, update the last activity time
            $_SESSION["last_activity"] = time();
        }
    } else {
        // User is not logged in, redirect to login page
        header("Location: login.html");
        exit;
    }
?>