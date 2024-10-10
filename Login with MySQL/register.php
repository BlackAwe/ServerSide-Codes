<?php
$conn = new mysqli('localhost', 'root', '', 'login_system');

// check the connection
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}

// checking if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    // Load the query
    if ($conn->query($sql) == TRUE) {
        echo "Registration is now complete";
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
