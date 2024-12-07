<?php
require 'db.php';

$search = $_GET['search'] ?? '';
$query = "SELECT * FROM users";
$params = [];

if ($search) {
    $query .= " WHERE name LIKE :search OR email LIKE :search";
    $params['search'] = '%' . $search . '%';
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>User List</h1>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
    </form>
    <a href="create.php">Add User</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td>
                <a href="update.php?id=<?= $user['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
