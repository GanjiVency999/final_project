<?php
include 'db.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id=$id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request.";
}
?>