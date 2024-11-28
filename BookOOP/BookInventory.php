<?php
require_once 'Book.php';

class BookInventory
{
    private $pdo;

    public function __construct($host, $dbname, $username, $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function createBook($title, $author, $year, $isbn, $genre)
    {
        try {
            $book = new Book($title, $author, $year, $isbn, $genre);
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author, year, isbn, genre) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$book->getTitle(), $book->getAuthor(), $book->getYear(), $book->getISBN(), $book->getGenre()]);
            echo "Book added successfully!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readBooks()
    {
        $stmt = $this->pdo->query("SELECT * FROM books");
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>";

        foreach ($books as $bookData) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($bookData['id']) . "</td>";
            echo "<td>" . htmlspecialchars($bookData['title']) . "</td>";
            echo "<td>" . htmlspecialchars($bookData['author']) . "</td>";
            echo "<td>" . htmlspecialchars($bookData['year']) . "</td>";
            echo "<td>" . htmlspecialchars($bookData['isbn']) . "</td>";
            echo "<td>" . htmlspecialchars($bookData['genre']) . "</td>";
            echo "<td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($bookData['id']) . "'>
                        <input type='hidden' name='title' value='" . htmlspecialchars($bookData['title']) . "'>
                        <input type='hidden' name='author' value='" . htmlspecialchars($bookData['author']) . "'>
                        <input type='hidden' name='year' value='" . htmlspecialchars($bookData['year']) . "'>
                        <input type='hidden' name='isbn' value='" . htmlspecialchars($bookData['isbn']) . "'>
                        <input type='hidden' name='genre' value='" . htmlspecialchars($bookData['genre']) . "'>
                        <input type='submit' name='edit' value='Edit'>
                    </form>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($bookData['id']) . "'>
                        <input type='submit' name='delete' value='Delete' onclick='return confirm(\"Are you sure you want to delete this book?\");'>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    }

    public function updateBook($id, $title, $author, $year, $isbn, $genre)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE books SET title = ?, author = ?, year = ?, isbn = ?, genre = ? WHERE id = ?");
            $stmt->execute([$title, $author, $year, $isbn, $genre, $id]);
            if ($stmt->rowCount() == 0) throw new Exception("Book not found with ID: $id");
            echo "Book updated successfully!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteBook($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM books WHERE id = ?");
            $stmt->execute([$id]);
            if ($stmt->rowCount() == 0) throw new Exception("Book not found with ID: $id");
            echo "Book deleted successfully!";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
