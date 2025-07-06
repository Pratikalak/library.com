<?php
// Public search endpoint — no session check
$q = $_GET['q'] ?? '';
$conn = mysqli_connect('db','librarian','library123','library');
if (!$conn) { die('DB connection error'); }

$sql = "SELECT * FROM books WHERE title LIKE '%$q%'";
$res = mysqli_query($conn, $sql);
if (!$res) { die('Query error: '.mysqli_error($conn)); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Search</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        input { padding: 8px; width: 300px; }
        button { background: #4CAF50; color: white; border: none; padding: 8px 15px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Books</h2>
        <form method="GET">
            <input type="text" name="q" value="<?php echo htmlspecialchars($q); ?>" placeholder="Search books...">
            <button type="submit">Search</button>
        </form>
        <div class="results">
            <?php
            while($row = mysqli_fetch_assoc($res)) {
                echo "<div class='book'>{$row['title']}</div>";
            }
            ?>
        </div>
        <p><a href="index.php">Back to Login</a> | <a href="dashboard.php">Dashboard</a></p>
    </div>
</body>
</html>
