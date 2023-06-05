<?php
    include "conn.php";
    
    $encryptedUsername = base64_decode($_POST['username']);
    $encryptedEmail = base64_decode($_POST['email']);
    $encryptedPassword = base64_decode($_POST['password']);
    $encryptedCpf = base64_decode($_POST['cpf']);
    $encryptedPhone = base64_decode($_POST['phone']);

    // Read the private key from a file
    $privateKey = file_get_contents('private_key.pem');

    $privateKeyResource = openssl_pkey_get_private($privateKey);

    // Decrypt the data
    openssl_private_decrypt($encryptedUsername, $username, $privateKeyResource);
    openssl_private_decrypt($encryptedEmail, $email, $privateKeyResource);
    openssl_private_decrypt($encryptedPassword, $password, $privateKeyResource);
    openssl_private_decrypt($encryptedCpf, $cpf, $privateKeyResource);
    openssl_private_decrypt($encryptedPhone, $phone, $privateKeyResource);

    // Insert decrypted data into the database
    $query = "INSERT INTO users (username, email, password, cpf, phone)
    VALUES ('$username', '$email', '$password', '$cpf', '$phone')";

    if ($conn->query($query) === TRUE) {
        http_response_code(200); // OK
    } else {
        http_response_code(500); // Internal Server Error
    }

    $conn->close();
?>
