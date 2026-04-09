<?php
    require 'connexion.php';
    require 'article.php';

    $database = new Database();
    $db = $database->getconnection();
    $article = new Article($db);

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $title   = trim($_POST['title']);
        $content = trim($_POST['content']);
        $id_user = trim($_POST['id_user']);

        if (empty($title) || empty($content) || empty($id_user)) {
            $error = "Please fill in all fields.";
        } elseif (!is_numeric($id_user)) {
            $error = "User ID must be a number.";
        } else {
            $title        = htmlspecialchars($title);
            $content      = htmlspecialchars($content);
            $publish_date = date('Y-m-d H:i:s');

            if ($article->create($title, $content, $id_user, $publish_date)) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Error: could not create post.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <style>
        * {
             box-sizing: border-box;
              margin: 0;
               padding: 0;
             }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f6fa;
            color: #333;
            padding: 2rem;
            display: flex;
            justify-content: center;
        }

        .card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem 2rem;
            width: 100%;
            max-width: 600px;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #e6f1fb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .card-header h2 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .error-box {
            background: #fff0f0;
            color: #A32D2D;
            border: 1px solid #F09595;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 1rem;
        }

        .form-group { margin-bottom: 1.2rem; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #666;
            margin-bottom: 6px;
        }

        input[type=text],
        input[type=number],
        textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            background: #fff;
            outline: none;
            transition: border 0.15s;
        }

        input:focus, textarea:focus {
            border-color: #378ADD;
            box-shadow: 0 0 0 3px #e6f1fb;
        }

        textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.6;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
        }

        .btn-submit {
            flex: 1;
            padding: 10px;
            background: #185FA5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-submit:hover { background: #0C447C; }

        .btn-back {
            padding: 10px 18px;
            background: #f5f6fa;
            color: #666;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back:hover { background: #eaecf0; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <div class="icon-wrap">✏️</div>
        <h2>Create new post</h2>
    </div>

    <?php if (!empty($error)): ?>
        <div class="error-box">⚠️ <?php echo $error; ?></div>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" placeholder="Enter post title..."value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>" />
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" placeholder="Write your content here..." ><?php    echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';?></textarea>
        </div>

        <div class="form-group">
            <label>User ID</label>
            <input type="text" name="id_user" placeholder="e.g. 1" value="<?php echo isset($_POST['id_user']) ? htmlspecialchars($_POST['id_user']) : ''; ?>"/>
        </div>

        <div class="btn-group">
            <a href="index.php" class="btn-back">← Back to list</a>
            <button type="submit" class="btn-submit">💾 Save post</button>
        </div>
    </form>
</div>

</body>
</html>