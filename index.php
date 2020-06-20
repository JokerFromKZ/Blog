<!doctype html>
<html lang="ru">
<head>
    <?
    $website_title = "BLOG";
    require 'blocks/head.php'?>
</head>
<body>

    <? require 'blocks/header.php' ?>



<main class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <?php
                require_once 'mysql_connect.php';

                $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC ';
                $query = $pdo->query($sql);
                while($row = $query->fetch(PDO::FETCH_OBJ)){
                    echo "<h2>$row->title</h2>
                          <p>$row->intro</p>
                          <p><b>Article's author:</b> <mark>$row->author</mark></p>
                          <a href='news.php?id=$row->id' title = '$row->title'> 
                            <buttom class = 'btn btn-warning mb-5'>read more</buttom>  
                          </a>";
                }
            ?>
        </div>
        <? require 'blocks/aside.php' ?>
    </div>
</main>

    <? require 'blocks/footer.php' ?>

</body>
</html>