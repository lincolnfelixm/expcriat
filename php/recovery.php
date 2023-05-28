<?php

    include 'conn.php';

    $email = $_POST['email'];
    $token = $_POST['token'];

    $query = "SELECT email, token FROM users WHERE email = '{$email}' AND token = '{$token}'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    $response = array();

    if (mysqli_num_rows($result) > 0) {
        $newPassword = $_POST['newPassword'];

        $updateQuery = "UPDATE users SET password = '{$newPassword}' WHERE email = '{$email}'";

        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            die('Error: ' . mysqli_error($conn));
        }

        // Reset token
        $resetTokenQuery = "UPDATE users SET token = NULL WHERE email = '{$email}'";
        $resetTokenResult = mysqli_query($conn, $resetTokenQuery);
        if (!$resetTokenResult) {
            die('Error: ' . mysqli_error($conn));
        }

        $response['success'] = true;
    } else {
        $response['success'] = false;
    }

    mysqli_close($conn);

    echo json_encode($response);
?>
