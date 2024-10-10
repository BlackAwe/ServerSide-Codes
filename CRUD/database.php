<?php
function connectDB()
{
    $servername = "localhost";
    $username = "justin_admin";
    $password = "o_viBJR)zJzxeTNj";
    $dbname = "library";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<br>Connected successfully";
    return $conn;
}
