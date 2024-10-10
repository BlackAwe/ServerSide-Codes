<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

// When login form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;

    if (!isset($_COOKIE['cart'])) { // sets the cart cookie if it doesn't exist
        setcookie('cart', json_encode([]), time() + (7 * 24 * 60 * 60), "/");
    }

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <p>Login</p>

    <!-- Display error message if applicable -->
    <?php if (isset($error_message)): ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="index.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>