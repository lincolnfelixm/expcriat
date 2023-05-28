<?php

    include "conn.php";
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpf = $_POST['cpf'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO users (username, email, password, cpf, phone)
    VALUES ('$username', '$email', '$password', '$cpf', '$phone')";

    if ($conn->query($query) === TRUE) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }

    $conn->close();
    
?>

