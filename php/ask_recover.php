<?php

    include 'conn.php';
    include 'mailer.php';

    $email = $_POST['email'];

    $query = "SELECT email FROM users WHERE email = '$email'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        sendTokenEmail($email);
        http_response_code(200); // OK
    } else {
        http_response_code(404); // Not Found
    }

?>
