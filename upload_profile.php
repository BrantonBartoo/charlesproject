<?php
include 'db_connect.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_picture"])) {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate file type
    $allowed_types = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Only JPG, JPEG, and PNG files are allowed.";
        exit();
    }

    // Move uploaded file to uploads directory
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        // Update user's profile picture in the database
        $update_query = "UPDATE users SET profile_picture = ? WHERE id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("si", $file_name, $user_id);

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile picture.";
        }
    } else {
        echo "Failed to upload file.";
    }
}
?>
