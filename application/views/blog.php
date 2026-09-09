<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
       <?php foreach ($blogs as $key => $blog): ?>
        <h1><?php echo $blog['title'] ?></h1>
        <p><?php echo $blog['description'] ?></p>
      <?php endforeach; ?>
</body>
</html>