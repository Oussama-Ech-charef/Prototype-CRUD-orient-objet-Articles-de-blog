<?php
require_once 'connexion.php';
require_once 'article.php';

$database = new Database();
$db = $database->getConnection();
$article = new Article($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish_date = $_POST['publish_date'];
    
  
    $id_user = 1; 
    $id_category = 1;

    if ($article->create($title, $content, $publish_date)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Could not create post.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Post</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f9f9f9;
            padding: 50px;
        }

        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 400px;
            margin: auto;

            display: flex;
            flex-direction: column; 
            gap: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }
</style>
</head>
<body>

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

</body>
</html>