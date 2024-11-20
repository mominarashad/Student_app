<?php
include 'db.php';
include 'navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Server-side validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the database query to insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);

        header('Location: signin.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Client-side validation using JavaScript
        function validateForm() {
            const name = document.forms["signupForm"]["name"].value;
            const email = document.forms["signupForm"]["email"].value;
            const password = document.forms["signupForm"]["password"].value;
            
            if (name === "" || email === "" || password === "") {
                alert("All fields must be filled out");
                return false;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <form name="signupForm" action="signup.php" method="post" onsubmit="return validateForm()">
        <h2>Sign Up</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
