<?php
include 'db_connect.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Fetch user details
$user_query = "SELECT fullname, email, profile_picture FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch applications for the logged-in user
$sql = "SELECT id, financial_situation, academic_goals, career_aspirations, status FROM bursary_applications WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
   <style>
    /* Profile Header */
.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    border: 3px solid #007BFF;
    object-fit: cover;
    margin-right: 15px;
}

.profile-info h2 {
    margin: 0;
    font-size: 22px;
}

.profile-info p {
    margin: 5px 0;
    color: #555;
}

/* Upload Form */
form {
    margin-bottom: 20px;
}

input[type="file"] {
    margin-bottom: 10px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background: #007BFF;
    color: white;
}

/* Status Colors */
td.pending {
    color: orange;
}

td.approved {
    color: green;
}

td.rejected {
    color: red;
}

/* Buttons */
.actions {
    margin-top: 20px;
    text-align: center;
}

.btn {
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s;
}

.btn.logout {
    background-color: red;
}

.btn:hover {
    background-color: #0056b3;
}

   </style> 
</head>
<body>

    <div class="container">

        <!-- Profile Section -->
        <div class="profile-header">
            <img src="<?php echo $user['profile_picture'] ? 'uploads/' . $user['profile_picture'] : 'uploads/default.png'; ?>" 
                 alt="Profile Picture" class="profile-pic">
            <div class="profile-info">
                <h2><?php echo htmlspecialchars($user["fullname"]); ?></h2>
                <p><?php echo htmlspecialchars($user["email"]); ?></p>
            </div>
        </div>

        <!-- Profile Picture Upload Form -->
        <form action="upload_profile.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="profile_picture" accept="image/*" required>
            <button type="submit">Upload Profile Picture</button>
        </form>

        <h2>My Bursary Applications</h2>

        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>Financial Situation</th>
                    <th>Academic Goals</th>
                    <th>Career Aspirations</th>
                    <th>Status</th>
                </tr>
                <?php $count = 1; ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo htmlspecialchars($row["financial_situation"]); ?></td>
                        <td><?php echo htmlspecialchars($row["academic_goals"]); ?></td>
                        <td><?php echo htmlspecialchars($row["career_aspirations"]); ?></td>
                        <td class="status <?php echo strtolower($row["status"]); ?>">
                            <?php echo htmlspecialchars($row["status"]); ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p class="no-applications">You have not submitted any applications yet.</p>
        <?php endif; ?>

        <div class="actions">
            <a href="application.php" class="btn">Apply for a Bursary</a>
            <a href="logout.php" class="btn logout">Logout</a>
        </div>

    </div>

</body>
</html>

<?php
$stmt->close();
$user_stmt->close();
$conn->close();
?>
