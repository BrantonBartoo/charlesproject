<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "bursary_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the email already exists in the database
        $sql_check = "SELECT email FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check);
        if ($stmt_check === false) {
            die('Error preparing SQL statement: ' . $conn->error);
        }
        
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $error = "Email is already registered!";
        } else {
            // Insert user into the database
            $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('Error preparing SQL statement: ' . $conn->error);
            }

            $stmt->bind_param("sss", $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Registration successful! <a href='login.php'>Login here</a>";
            } else {
                $error = "Error executing query: " . $stmt->error;
            }

            $stmt->close();
        }

        $stmt_check->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bursary Management System</title>
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
    margin-bottom: 30px; /* Add margin to separate header from the profile container */
}

main {
    width: 100%;
    display: flex;
    justify-content: center;
    flex-grow: 1; /* Allow the main content area to grow and take available space */
    padding: 30px;
}

.profile-container {
    max-width: 800px;
    width: 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-container:hover {
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
}

p {
    font-size: 16px;
    color: #555;
}

#status, #availability {
    font-weight: bold;
    color: #28a745; /* Green color */
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

form input[type="number"], form input[type="text"], form input[type="email"], form input[type="password"] {
    padding: 12px;
    font-size: 16px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    width: 100%;
    max-width: 400px; /* To limit the width of the inputs */
    box-sizing: border-box;
}

.logout-section {
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
        <h1>Create Your Account</h1>
    </header>

    <main>
        <section class="registration-form">
            <h2>Sign Up for Bursary Management System</h2>

            <!-- Display any error or success messages -->
            <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>

            <form action="register.php" method="POST">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="button">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Bursary Management System. All rights reserved.</p>
    </footer>
</body>
</html>
