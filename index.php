<?php


require 'connexion.php';

require 'article.php';




$database = new Database();
$db = $database->getconnection();

$post = new Article($db);

$articles = $post->all();

?>




<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>

     <style>
         table {
             width: 80%;
             margin: 20px auto;
             border-collapse: collapse;
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

<h1>List of Articles</h1>
    <a href="create.php" class="btn-add">+ Create New Post</a>

    <table>
         <thead>
            <tr>
                <th>ID</th><th>Title</th><th>Content</th><th>Publish Date</th>
            </tr>
        </thead>

        <tbody>

            <?php 
                
                    foreach ($articles as $article) {
                        echo "<tr>";
                        echo "<td>" . $article['id_post'] . "</td>";
                        echo "<td>" . $article['title'] . "</td>";
                        echo "<td>" . $article['content'] . "</td>";
                        echo "<td>" . date('Y - m - d', strtotime($article['publish_date'])) . "</td>";
                        echo "</tr>";

                    }


                    
                
            
            ?>


        </tbody>
    </table>



</body>
</html>