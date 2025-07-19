<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts from the database
$sql = "SELECT * FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<h2>All Blog Posts</h2>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["title"] . "</h3>";
        echo "<p>" . $row["content"] . "</p>";
        echo "<small>Posted on: " . $row["created_at"] . "</small><br>";
        
        // Edit and Delete buttons
        echo "<a href='edit_post.php?id=" . $row["id"] . "'>✏ Edit</a> | ";
        echo "<a href='delete_post.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this post?');\">🗑 Delete</a><hr>";
    }
} else {
    echo "No blog posts found.";
}

$conn->close();
?>
