<?php
require 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (!$name || !$email || !$phone) {
        $error = 'All fields are required!';
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)");
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone]);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Create New User</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone">
        <button type="submit">Create</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
