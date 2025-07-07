<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'normal') {
    header('Location: index.php');
    exit;
}
$file = $_GET['file'] ?? '';
$path = "uploads/" . $file;
if (file_exists($path)) {
    include $path;
} else {
    echo "File not found.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Download</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        input { padding: 8px; width: 300px; }
        button { background: #4CAF50; color: white; border: none; padding: 8px 15px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Download File</h2>
        <form method="GET">
            <input type="text" name="file" placeholder="uploads/shell.php or ../../etc/passwd" value="<?php echo htmlspecialchars($file); ?>">
            <button type="submit">Download</button>
        </form>
        <div class="file-output">
            <?php
            if ($file) {
                // dangerously include any file under uploads or via traversal
                @include "uploads/{$file}";
            }
            ?>
        </div>
        <p><a href="index.php">Back to Login</a> | <a href="dashboard.php">Dashboard</a></p>
    </div>
</body>
</html>
