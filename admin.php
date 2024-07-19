<?php
session_start();
include_once "php/config.php";

// Check if the user is logged in and is an admin
if (!isset($_SESSION['unique_id']) || $_SESSION['role'] !== 'admin') {
    header("location: index.php");
    exit;
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="admin-panel">
        <h2>Admin Panel - Manage Users</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Profile Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['ProfileName']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><a href="delete_user.php?id=<?php echo $row['user_id']; ?>">Delete</a></td>
            </tr>
            <?php } ?>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
