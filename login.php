<?php
// Start the session
session_start();

// Check if the user is already logged in, if so redirect to profile page
if (isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit();
}

// Initialize error message variable
$error = "";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "bursary_system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user from database
    $sql = "SELECT id, fullname, password, is_admin FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $fullname, $hashed_password, $is_admin);
        $stmt->fetch();
    
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $user_id;
            $_SESSION["fullname"] = $fullname;
            $_SESSION["is_admin"] = $is_admin;
    
            // Redirect based on role
            if ($is_admin == 1) {
                header("Location: admin_dashboard.php"); // Change to your admin page
            } else {
                header("Location: profile.php");
            }
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "No user found with that email.";
    }
    
    

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bursary Management System</title>
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f7fc;
    color: #333;
    display: flex;
    flex-direction: column; /* Use column layout */
    justify-content: space-between; /* Distribute space between elements */
    min-height: 100vh;
}

header {
    background-color: #007BFF;
    color: white;
    text-align: center;
    padding: 20px 0;
    font-size: 24px;
    margin-bottom: 30px; /* Add margin to separate header from the login container */
}

main {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-grow: 1; /* Allow the main content area to grow and take available space */
    padding: 30px;
}

.login-container {
    max-width: 400px;
    width: 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-container:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

section {
    margin-bottom: 20px;
}

h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: center;
}

p {
    font-size: 16px;
    color: #555;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form label {
    font-size: 16px;
    margin-bottom: 5px;
    color: #555;
}

form input[type="email"], form input[type="password"] {
    padding: 12px;
    font-size: 16px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    width: 100%;
    max-width: 400px; /* To limit the width of the inputs */
    box-sizing: border-box;
}

button {
    background-color: #007BFF;
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

button:hover {
    background-color: #0056b3;
}

.login-container p {
    font-size: 14px;
    color: #555;
    text-align: center;
}

footer {
    text-align: center;
    padding: 10px 0;
    background-color: #f1f1f1;
    color: #888;
    font-size: 14px;
    margin-top: 30px;
}

    </style>
</head>
<body>
    <header>
        Login to Your Account
    </header>
    
    <main>
        <div class="login-form">
            <h2>Login</h2>
            
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>

    <footer>
        &copy; 2025 Bursary Management System. All rights reserved.
    </footer>
</body>
</html>
