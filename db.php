<?php
// db.php - Establish a database connection

$host = 'localhost';
$dbname = 'student_managements';
$user = 'root';
$password = 'Momina0192004.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
