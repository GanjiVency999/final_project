<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "blog_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $created_at = time(); // current timestamp

    // Insert into posts table
    $sql = "INSERT INTO posts (title, content, created_at) VALUES ('$title', '$content', $created_at)";
    
    if ($conn->query($sql) === TRUE) {
        echo "Post added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!-- HTML Form -->
<h2>Add Blog Post</h2>
<form method="POST" action="">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="5" cols="40" required></textarea><br><br>

    <input type="submit" value="Add Post">
</form>
