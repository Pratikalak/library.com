<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$file = $_GET['file'] ?? '';
include "uploads/{$file}";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Download</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container">
        <h2>Download File</h2>
        <form method="GET">
            <input type="text" name="file" placeholder="Enter file path">
            <button type="submit">Download</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
