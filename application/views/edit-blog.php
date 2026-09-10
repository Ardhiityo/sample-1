<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="<?php echo $blog['title'] ?>">
        </div>
        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content">
                <?php echo $blog['content'] ?>
            </textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>