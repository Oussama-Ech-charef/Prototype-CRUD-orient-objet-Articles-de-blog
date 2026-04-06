<?php


require 'connexion.php';
require 'article.php';


$database = new Database();
$db = $database->getConnection();
$article = new Article($db);


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish_date = $_POST['publish_date'];


    if ($article->create($title, $content, $publish_date)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Could not create post.";
    }
}


?>




<div class="form-container">
        <h1>Add New Post</h1>
        <form action="create.php" method="POST">
            <input type="text" name="title" placeholder="Enter post title" required>
            <textarea name="content" rows="5" placeholder="Enter post content" required></textarea>
            <input type="date" name="publish_date" required> 
            <button type="submit">Publish Post</button>
        </form>
        <a href="index.php" class="back-link">Back to List</a>
    </div>