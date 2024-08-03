<?php
// Name: Guokai Shi
// File Name: logout.php
// Date Created: 2024-07-18
// Description: This PHP file handles user logout, displaying a thank you message and redirecting to the index page after a short delay.

session_start();

// Destroy all session data
session_unset();
session_destroy();

// Set a delay for 3 seconds
$delay = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <meta http-equiv="refresh" content="<?php echo $delay; ?>;url=../index.php">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }
        .message {
            text-align: center;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="message">
        <h1>Thank You for Using Our Service</h1>
        <p>Looking forward to your next visit</p>
    </div>
</body>
</html>
