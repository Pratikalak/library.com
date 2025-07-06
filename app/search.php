<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$q = $_GET['q'] ?? '';
$conn = mysqli_connect('db','librarian','library123','library');
$res = mysqli_query($conn, "SELECT * FROM books WHERE title LIKE '%$q%'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Library.com - Search</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f0f2f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .search-box { margin: 20px 0; }
        input { padding: 8px; width: 300px; }
        button { background: #4CAF50; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 4px; }
        .book { margin: 10px 0; padding: 10px; background: #f8f9fa; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Search Books</h2>
        <div class="search-box">
            <form method="GET">
                <input type="text" name="q" value="<?php echo htmlspecialchars($q); ?>" placeholder="Search books...">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="results">
            <?php
            if ($res) {
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<div>{$row['title']}</div>";
                }
            }
            ?>
        </div>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
