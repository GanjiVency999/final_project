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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>✅ Post updated successfully!</p>";
    } else {
        echo "❌ Error updating post: " . $conn->error;
    }
}

// Get existing post data
$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2>Edit Blog Post</h2>

<form method="post" action="">
    Title: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>
    Content:<br>
    <textarea name="content" rows="5" cols="40"><?php echo $row['content']; ?></textarea><br><br>
    <input type="submit" value="Update Post">
</form>
