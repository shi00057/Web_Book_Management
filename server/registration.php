<?php
// Name: Guokai Shi
// File Name: registration.php
// Date Created: 2024-07-18
// Description: This PHP file handles user registration, including form validation and database insertion.

session_start();

include 'Dao/AbstractDao.php';
include 'Dao/UserDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $username = trim($_POST['login']);
    $password = trim($_POST['pass']);
    $password2 = trim($_POST['pass2']);

    // Validate inputs
    if (empty($email) || empty($username) || empty($password) || empty($password2)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $password2) {
        $error = "Passwords do not match.";
    } else {
        // Get database connection
        $userDAO = new UserDAO();
        $checkUser = $userDAO->getUserByEmail($email);
        if (count($checkUser) > 0) {
            $error = "User already exists.";
        } else {
            // Insert new user into the database
            $user_id = $userDAO->addUser($username, $email, $password);
            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $success = "Registration successful! Redirecting to homepage...";
            header("Location: home.php");
            exit();

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../CSS/registration.css">
    <script src="../Scripts/registration.js"></script>
</head>
<body>
<?php include('header.php'); ?>
<div class="formcontainer">
    <h1>Weekly Kitten Pictures Subscription</h1>
    <hr>
    <form action="registration.php" method="post" onsubmit="return validate();">
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php elseif (isset($success)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>

        <div class="textfield">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>

        <div class="textfield">
            <label for="login">User Name</label>
            <input type="text" name="login" id="login" placeholder="User name">
        </div>

        <div class="textfield">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" placeholder="Password">
        </div>

        <div class="textfield">
            <label for="pass2">Re-type Password</label>
            <input type="password" name="pass2" id="pass2" placeholder="Re-type Password">
        </div>

        <div class="checkbox">
            <input type="checkbox" name="newsletter" id="newsletter">
            <label for="newsletter">I agree to receive Weekly newsletters</label>
        </div>

        <div class="checkbox">
            <input type="checkbox" name="terms" id="terms">
            <label for="terms">I agree to the terms and conditions</label>
        </div>

        <button type="submit">Sign-Up</button>
        <button type="reset">Reset</button>
    </form>
</div>
<?php include('footer.php'); ?>
</body>
</html>
