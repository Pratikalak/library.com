<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $db_path = __DIR__ . '/../db/library.db';
    if (!file_exists($db_path)) {
        $error = "Database missing. Contact admin.";
    } else {
        $db = new SQLite3($db_path);
        $stmt = $db->prepare('SELECT username, password, role FROM users WHERE username = :username AND password = :password');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if ($row && $row['username'] === 'normal' && $row['password'] === 'library123') {
            $_SESSION['user'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Access Denied.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f0f2f5; }
        .login-form { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        input { display: block; margin: 10px 0; padding: 8px; width: 200px; }
        button { background: #4CAF50; color: white; border: none; padding: 10px; width: 100%; cursor: pointer; border-radius: 4px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Library.com Login</h2>
        <?php if ($error): ?><div class="error"><?php echo $error; ?></div><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
