<?php
include 'db.php';
session_start();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM admissions WHERE id = ?");
$stmt->execute([$id]);

header('Location: dashboard.php');
exit;
?>
