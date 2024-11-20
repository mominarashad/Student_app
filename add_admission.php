<?php
include 'db.php';
include 'navbar.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the sign-in page
    header('Location: signin.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data to prevent SQL injection
    $name = htmlspecialchars($_POST['student_name']);
    $course = htmlspecialchars($_POST['course']);
    $age = (int) $_POST['age'];

    // Prepare the SQL statement to insert the admission data
    $stmt = $pdo->prepare("INSERT INTO admissions (student_name, course, age) VALUES (?, ?, ?)");
    $stmt->execute([$name, $course, $age]);

    // Redirect to the dashboard after successfully adding the admission
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="add_admission.php" method="post">
        <h2>Add Admission</h2>
        <input type="text" name="student_name" placeholder="Student Name" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="number" name="age" placeholder="Age" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>
