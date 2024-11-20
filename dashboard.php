<?php
include 'db.php';
include 'navbar.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit;
}

$stmt = $pdo->query("SELECT * FROM admissions");
$admissions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Student Admissions</h2>
    <a href="add_admission.php">Add New Admission</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Course</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($admissions as $admission): ?>
            <tr>
                <td><?= htmlspecialchars($admission['student_name']) ?></td>
                <td><?= htmlspecialchars($admission['course']) ?></td>
                <td><?= htmlspecialchars($admission['age']) ?></td>
                <td>
                    <a href="edit_admission.php?id=<?= $admission['id'] ?>" class="button edit">Edit</a>
                    <a href="delete_admission.php?id=<?= $admission['id'] ?>" class="button delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
