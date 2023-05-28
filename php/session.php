<?php
// Start or resume the session
session_start();

// Function to set session data
function set_session_data($key, $value) {
    $_SESSION[$key] = $value;
}

// Function to get session data
function get_session_data($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

// Function to check if user is logged in
function is_logged_in() {
    return get_session_data("loggedin") === true;
}

// Function to destroy the session and log out the user
function logout() {
    session_unset();
    session_destroy();
}

// Check if the session has expired
function check_session_expiry() {
    $expiryTime = 60 * 30; // 30 minutes (adjust as needed)
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $expiryTime)) {
        logout();
        // Redirect to the login page or display an error message
        // header("Location: login.php");
        // exit;
    }
    
    $_SESSION['last_activity'] = time();
}
