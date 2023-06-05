<?php
    include 'conn.php';
    include 'session.php'; 

    $encryptedLogin = $_POST["username"];
    $encryptedPassword = $_POST["password"];

    // Read the private key from a file
    $privateKey = file_get_contents('private_key.pem');

    $privateKeyResource = openssl_pkey_get_private($privateKey);

    // Decrypt the username and password
    openssl_private_decrypt($encryptedLogin, $decryptedLogin, $privateKeyResource);
    openssl_private_decrypt($encryptedPassword, $decryptedPassword, $privateKeyResource);

    // Using Prepared Statements to prevent SQL Injection
    $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $decryptedLogin, $decryptedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

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
