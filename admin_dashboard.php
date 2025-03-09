<?php
include 'db_connect.php';
session_start();

// Ensure only admin can access this page
if (!isset($_SESSION["user_id"]) || $_SESSION["is_admin"] != 1) {
    header("Location: login.php");
    exit();
}

// Fetch all bursary applications
$sql = "SELECT b.id, b.financial_situation, b.academic_goals, b.career_aspirations, b.status, u.fullname, u.email
        FROM bursary_applications b
        JOIN users u ON b.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   <style>
    /* Admin Page Styling */
.admin-header {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

/* Table for applications */
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

/* Approve/Reject Buttons */
.btn {
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    color: white;
}

.btn.approve {
    background: green;
}

.btn.reject {
    background: red;
}
.logout-btn {
    display: block;  /* Ensures it's a single button */
    width: fit-content;
    padding: 10px 20px;
    background-color: #ff4d4d;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    margin: 20px auto;  /* Center the button */
}

.logout-btn:hover {
    background-color: #cc0000;
}


   </style>
</head>
<body>

    <div class="container">
        <h2>Admin Dashboard - Manage Applications</h2>

        <?php if ($result->num_rows > 0) : ?>
            <table>
                <tr>
                    <th>#</th>
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Financial Situation</th>
                    <th>Academic Goals</th>
                    <th>Career Aspirations</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php $count = 1; ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo htmlspecialchars($row["fullname"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["financial_situation"]); ?></td>
                        <td><?php echo htmlspecialchars($row["academic_goals"]); ?></td>
                        <td><?php echo htmlspecialchars($row["career_aspirations"]); ?></td>
                        <td class="status <?php echo strtolower($row["status"]); ?>">
                            <?php echo htmlspecialchars($row["status"]); ?>
                        </td>
                        <td>
                            <form action="update_application_status.php" method="POST">
                                <input type="hidden" name="application_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                                <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <p class="no-applications">No bursary applications found.</p>
        <?php endif; ?>

        <div class="actions">
            <a href="logout.php" class="btn logout">Logout</a>
        </div>
    </div>
    <div class="admin-header">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>


</body>
</html>

<?php
$conn->close();
?>
