<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <form method="get">
        <input type="text" name="find">
        <button type="submit">Cari</button>
     </form>    

      <a href="<?php echo site_url('blog/add') ?>">Tambah</a>    

       <?php foreach ($blogs as $key => $blog): ?>
        <h1>
            <a href="<?php echo site_url("blog/detail/".$blog['url'])  ?>">
                <?php echo $blog['title'] ?>
            </a>
        </h1>
        <p><?php echo $blog['content'] ?></p>
        <a href="<?php echo "/blog/edit/".$blog['id']?>">Edit</a>
        <a href="<?php echo "/blog/delete/".$blog['id']?>">Delete</a>
       <?php endforeach; ?>
</body>
</html>