<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .nav { margin: 20px 0; }
        .nav a { margin-right: 15px; color: #4CAF50; text-decoration: none; }
        .flag { background: #e8f5e9; padding: 10px; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, admin</h2>
        <div class="flag">
            FLAG{user_flag_here}
        </div>
        <div class="nav">
            <a href="search.php">Search Books</a>
            <a href="upload.php">Upload File</a>
            <a href="download.php">Download File</a>
        </div>
    </div>
</body>
</html>
