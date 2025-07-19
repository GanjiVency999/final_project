<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete the post
$sql = "DELETE FROM posts WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Post deleted successfully!</p>";
    echo "<a href='view_posts.php'>Go back to blog list</a>";
} else {
    echo "❌ Error deleting post: " . $conn->error;
}

$conn->close();
?>
