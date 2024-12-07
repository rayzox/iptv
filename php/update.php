<?php
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (!$name || !$email || !$phone) {
        $error = 'All fields are required!';
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'id' => $id
        ]);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Update User</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
        <button type="submit">Update</button>
        <a href="index.php">Cancel</a>
    </form>
</body>
</html>
