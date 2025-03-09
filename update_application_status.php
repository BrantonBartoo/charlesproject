<?php
include 'db_connect.php';
session_start();

// Ensure only admin can update application status
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["application_id"], $_POST["action"])) {
    $application_id = $_POST["application_id"];
    $new_status = ($_POST["action"] === "approve") ? "Approved" : "Rejected";

    // Update the application status in the database
    $update_query = "UPDATE bursary_applications SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_status, $application_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating application status.";
    }
}
?>
