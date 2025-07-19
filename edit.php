<?php
include 'db.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating post: " . mysqli_error($conn);
    }
} else {
    $sql = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h2>Edit Post</h2>
    <form method="POST" action="">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br><br>

        <label>Content:</label><br>
        <textarea name="content" rows="5" cols="30" required><?php echo $row['content']; ?></textarea><br><br>

        <button type="submit">Update Post</button>
    </form>
    <br>
    <a href="index.php">← Back to Posts</a>
</body>
</html>
