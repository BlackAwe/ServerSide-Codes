<?php
include 'database.php';
?>
<?php

if (
    isset($_POST["bookID"])
    &&  isset($_POST["title"])
    &&  isset($_POST["author"])
) {
    $id = $_POST["bookID"];
    $title = $_POST["title"];
    $author = $_POST["author"];

    $conn = connectDB();
    $sql = "insert into books (BookID, 
      title , author)
   VALUES ('" . $id . "','" . $title . "', '" . $author . "')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Book Entry</title>
</head>

<body>
    <h2>Add New Book</h2>

    <form action="create.php" method="POST">
        <label for="bookID">Book ID:</label><br>
        <input type="text" id="bookID" name="bookID" required><br><br>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br><br>

        <input type="submit" value="Add Book">
    </form>
</body>

</html>