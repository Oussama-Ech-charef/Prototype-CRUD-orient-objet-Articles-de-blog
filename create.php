



<?php


    require 'connexion.php';
    require 'article.php';


    $database = new Database();
    $db = $database->getconnection();
    $article = new Article($db);



    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $publish_date = $_POST['publish_date'];


        if ($article->create($title, $content, $publish_date)) {
            header("Location: index.php");
            exit();
        } else {
            echo " Error : could not create post.";
        }

        
    }

?>
















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
</head>
<body>

<h1>Add New Post</h1>
        <form action="create.php" method="POST">
            <input type="text" name="title" placeholder="Enter post title" required><br><br>
            <textarea name="content" rows="5" placeholder="Enter post content" required></textarea><br><br>
            <input type="date" name="publish_date" required> <br><br>
            <button type="submit">Publish Post</button>
        </form>
        <a href="index.php">Back to List</a>


    
</body>
</html>