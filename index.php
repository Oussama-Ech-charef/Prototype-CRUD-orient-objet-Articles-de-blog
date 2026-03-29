<?php
require_once 'connexion.php';
require_once 'Article.php';

$database = new Database();
$db = $database->getConnection();

$post = new Article($db);

$articles = $post->all();
?>

<!DOCTYPE html>
<html lang="en"> <head>
    <meta charset="UTF-8">
    <title>Post List - My Blog</title>
    <style>
        table {
             width: 80%;
            margin: 20px auto;
            /* border-collapse: collapse; */
            font-family: sans-serif;
             }
        th, td {
             border: 1px solid #ddd;
              padding: 12px;
            text-align: left;
             }
        th {
             background-color: #f4f4f4;
             }
        h1 {
             text-align: center;
            color: #333;
             }
    </style>
</head>
<body>

    <h1>Post List (My Blog)</h1>
    <a href="create.php" class="btn-add">+ Create New Post</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Publish Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $row): ?>
                    <tr>
                        <td><?php echo $row['id_post']; ?></td>
                        
                        <td style="max-width: 200px;word-wrap: break-word;"><?php echo htmlspecialchars($row['title']); ?></td>
                        
                        <td style="max-width: 200px;word-wrap: break-word;"><?php echo htmlspecialchars($row['content']); ?></td>
                        
                        <td><?php echo $row['publish_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">No posts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>