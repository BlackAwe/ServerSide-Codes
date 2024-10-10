<?php
session_start();

// Redirect to login if user is not logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Book listing available for the bookstore
$book_listings = [
    "The Song of Achilles" => 499.00,
    "To Kill a Mockingbird" => 425.00,
    "Yellowface" => 1480.00,
    "Fahrenheit 451" => 445
];

// Initialize the cart from the cookie
$cart = json_decode($_COOKIE['cart'] ?? '[]', true); // Handle the case if the cart cookie doesn't exist

// Function to update the cart cookie
function updateCartCookie($cart)
{
    setcookie('cart', json_encode($cart), time() + (7 * 24 * 60 * 60), "/");
}

// Code for cart operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['book'])) { // ADD/CREATE OPERATIONS
        $bookName = $_POST['book'];
        $cart[$bookName] = $book_listings[$bookName]; // Add the selected book to the cart
        updateCartCookie($cart);
        header("Location: dashboard.php");
        exit;
    }

    // REMOVE OPERATIONS
    if (isset($_POST['remove_book'])) {
        $removedBook = $_POST['remove_book'];
        unset($cart[$removedBook]); // Remove the selected book from the cart
        updateCartCookie($cart);
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

    <h2>Add Books to Cart</h2>
    <form method="POST" action="">
        <label for="book">Select a book:</label>
        <select name="book" id="book">
            <?php foreach ($book_listings as $book => $price): ?>
                <option value="<?php echo htmlspecialchars($book); ?>">
                    <?php echo htmlspecialchars("$book (P$price)"); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Add to Cart">
    </form>

    <h2>Your Cart</h2>
    <?php if (!empty($cart)): ?>
        <ul>
            <?php foreach ($cart as $book => $price): ?>
                <li>
                    <?php echo htmlspecialchars("$book - P$price"); ?>
                    <form method='POST' action='' style='display:inline;'>
                        <input type='hidden' name='remove_book' value='<?php echo htmlspecialchars($book); ?>'>
                        <input type='submit' value='Remove'>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</body>

</html>