<?php
require_once 'BookInventory.php';

// Connect to the database
$inventory = new BookInventory('localhost', 'book_inventory', 'root', '');

// Default values for update form
$update_id = '';
$update_title = '';
$update_author = '';
$update_year = '';
$update_isbn = '';
$update_genre = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Create Book
        if (isset($_POST['create'])) {
            $inventory->createBook($_POST['title'], $_POST['author'], $_POST['year'], $_POST['isbn'], $_POST['genre']);
        }
        // Update Book
        if (isset($_POST['update'])) {
            $inventory->updateBook($_POST['id'], $_POST['title'], $_POST['author'], $_POST['year'], $_POST['isbn'], $_POST['genre']);
        }
        // Delete Book
        if (isset($_POST['delete'])) {
            $inventory->deleteBook($_POST['id']);
        }
        // Edit (Pre-fill update form)
        if (isset($_POST['edit'])) {
            $update_id = $_POST['id'];
            $update_title = $_POST['title'];
            $update_author = $_POST['author'];
            $update_year = $_POST['year'];
            $update_isbn = $_POST['isbn'];
            $update_genre = $_POST['genre'];
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Inventory Management</title>
    <Style>
    </Style>

</head>

<body>
    <h1 style="text-align: center;">Book Inventory Management System</h1>

    <!-- Form to create a new book -->
    <h2>Add a New Book</h2>
    <form method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br>

        <label for="year">Year:</label><br>
        <input type="number" id="year" name="year" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn" required><br>

        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre" required><br><br>

        <input type="submit" name="create" value="Add Book">
    </form>
    <br>
    <hr>

    <!-- Form to update an existing book -->
    <h2>Update Book Information</h2>
    <form method="POST">
        <label for="id">Book ID (to update):</label><br>
        <input type="number" id="id" name="id" value="<?php echo htmlspecialchars($update_id); ?>" required><br>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($update_title); ?>" required><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($update_author); ?>" required><br>

        <label for="year">Year:</label><br>
        <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($update_year); ?>" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($update_isbn); ?>" required><br>

        <label for="genre">Genre:</label><br>
        <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($update_genre); ?>" required><br>

        <input type="submit" name="update" value="Update Book">
    </form>
    <br>
    <hr>
    <br>
    <!-- Display all books -->
    <h2>Book Inventory</h2>
    <?php
    // Display all books from the database
    $inventory->readBooks();
    ?>
</body>

</html>