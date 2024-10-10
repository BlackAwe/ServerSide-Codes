  <?php
    include 'database.php';
    ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Library Management System</title>
  </head>

  <body>
      <h2>Welcome to the Library Management System!</h2>
      <a href="create.php">CREATE BOOK ENTRY</a>
      <?php
        $conn = connectDB();
        $results = $conn->query("SELECT * FROM books");

        if ($results->num_rows > 0) {
            echo "<table border='1'>";  // Start the table with a border
            echo "<tr><th>Book ID</th><th>Title</th><th>Author</th></tr>";  // Table headers

            while ($row = $results->fetch_assoc()) {
                echo "<tr>";  // Start a new row for each book
                echo "<td>" . $row["bookID"] . "</td>";  // Display Book ID
                echo "<td>" . $row["title"] . "</td>";   // Display Title
                echo "<td>" . $row["author"] . "</td>";  // Display Author
                echo "</tr>";  // End the row
            }

            echo "</table>";  // End the table
        }
        ?>


  </body>

  </html>