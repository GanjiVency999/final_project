<?php
include 'db.php';
session_start();

// Pagination
$limit = 5; // posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $limit;

// Search
$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY id DESC LIMIT $start_from, $limit";
    $totalQuery = "SELECT COUNT(*) FROM posts WHERE title LIKE '%$search%'";
} else {
    $query = "SELECT * FROM posts ORDER BY id DESC LIMIT $start_from, $limit";
    $totalQuery = "SELECT COUNT(*) FROM posts";
}

$result = mysqli_query($conn, $query);
$totalResult = mysqli_query($conn, $totalQuery);
$totalRows = mysqli_fetch_array($totalResult)[0];
$totalPages = ceil($totalRows / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome to My Blog</h2>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search title..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>

    <a href="add.php">Add New Post</a> | 
    <a href="logout.php">Logout</a>
    <hr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="post">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['content']; ?></p>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this post?')">Delete</a>
        </div>
        <hr>
    <?php } ?>

    <!-- Pagination -->
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>
</body>
</html>
