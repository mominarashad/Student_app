<?php
include 'db.php';
include 'navbar.php';
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM admissions WHERE id = ?");
$stmt->execute([$id]);
$admission = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['student_name'];
    $course = $_POST['course'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare("UPDATE admissions SET student_name = ?, course = ?, age = ? WHERE id = ?");
    $stmt->execute([$name, $course, $age, $id]);

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admission</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="edit_admission.php?id=<?= $id ?>" method="post">
        <h2>Edit Admission</h2>
        <input type="text" name="student_name" value="<?= htmlspecialchars($admission['student_name']) ?>" required>
        <input type="text" name="course" value="<?= htmlspecialchars($admission['course']) ?>" required>
        <input type="number" name="age" value="<?= htmlspecialchars($admission['age']) ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
