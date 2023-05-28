<?php
    include 'conn.php';
    include 'session.php'; 

    $login = $_POST["username"];
    $passwd = $_POST["password"];

    $query = "SELECT username, password FROM users WHERE username = '$login' AND password = '$passwd'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Login successful
        $row = $result->fetch_assoc();
        
        set_session_data("username", $row["username"]);
        set_session_data("loggedin", true);
        set_session_data("last_activity", time());

        http_response_code(200); // OK
        echo "Login successful!";
    } else {
        // Login failed
        http_response_code(401); // Unauthorized
        echo "Incorrect username or password";
    }
?>
