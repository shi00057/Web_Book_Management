<?php
// Name: Guokai Shi
// File Name: index.php
// Date Created: 2024-07-18
// Description: This PHP file serves as the main page of the website, displaying the home content and links to other sections.
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the necessary files from the Dao directory
include('./server/Dao/db_connection.php');
include('./server/Dao/UserDAO.php');

// Initialize an error message variable
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Get database connection
    $database = new Database();
    $db = $database->getConnection();

    // Initialize UserDAO
    $userDAO = new UserDAO($db);

    // Attempt to login
    $userId = $userDAO->login($email, $password);

    if ($userId) {
        $_SESSION['user_id'] = $userId;
        header("Location: ./server/home.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <?php include('./server/header.php'); ?>
    <div class="login-container">
        <h1>Log in</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php" method="post">
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="login-button">Log in</button>
                <a href="./server/registration.php" class="create-account-button">Create Account</a>
            </div>
        </form>
    </div>
    <?php include('./server/footer.php'); ?>
</body>
</html>
