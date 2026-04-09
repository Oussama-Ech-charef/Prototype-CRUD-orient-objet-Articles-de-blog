<?php


require 'connexion.php';

require 'article.php';


$database = new Database();

$db = $database->getConnection();

$article = new Article($db);

$articles = $article->all();





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Articles</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
            color: #333;
            padding: 2rem;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #1a1a2e;
        }

        .btn-add {
            display: inline-block;
            padding: 9px 18px;
            background-color: #185FA5;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: #0C447C;
        }

        .table-wrapper {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead tr {
            background-color: #f8f9fb;
        }

        thead th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #e8e8e8;
        }

        tbody tr {
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f0f6ff;
        }

        tbody td {
            padding: 12px 16px;
            color: #333;
        }

        tbody td:first-child {
            font-weight: 600;
            color: #999;
            font-size: 13px;
        }

        .content-cell {
            color: #666;
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-date {
            display: inline-block;
            background-color: #e6f1fb;
            color: #185FA5;
            font-size: 12px;
            padding: 3px 10px;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<h1>List of Articles</h1>
<a href="create.php" class="btn-add">+ Create New Post</a>

<div class="table-wrapper">
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
            <?php foreach($articles as $post): ?>
            <tr>
                <td>#<?php echo $post['id_post']; ?></td>
                <td><?php echo htmlspecialchars($post['title']); ?></td>
                <td class="content-cell"><?php echo htmlspecialchars($post['content']); ?></td>
                <td><span class="badge-date"><?php echo date('Y-m-d', strtotime($post['publish_date'])); ?></span></td>            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>

