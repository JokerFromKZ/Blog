<!doctype html>
<html lang="ru">
<head>
    <?
    require_once 'mysql_connect.php';

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id '; //получаем все данные связанные с id
    $query = $pdo->prepare($sql);
    $query->execute(['id' =>$_GET['id']]); //получаем id статьи

    $article = $query->fetch(PDO::FETCH_OBJ); // получаем обьект

    $website_title = $article->title;
    require 'blocks/head.php'?>;
</head>
<body>

<? require 'blocks/header.php'
?>



<main class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="jumbotron">
                <h1><?= $article->title?></h1>
                <p><b>Article's author:</b> <mark><?=$article->author?></mark></p>
                <?php
                //Добавление времени
                $date = date('d ', $article->date);
                $array = ['Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь' ];
                $date .= $array[date('n', $article->date) - 1];
                $date .= ' ';
                $date .= date('H:i', $article->date);
                ?>
                <p><b>Article's author:</b> <u><?=$date?></u></p>
                <p>
                    <?= $article->intro?>
                    <br><br>
                    <?= $article->text?>


                </p>
            </div>
            <?php
            if($_COOKIE['login'] != '') {
                echo "<a href=\"#\" id='edit_art' class=\"btn btn btn-success \">Edit</a>";
                echo "<a href=\"index.php\" class=\"btn btn-danger ml-2\" id = 'delete_art'>Delete</a>";
            }
            ?>

        </div>
        <? require 'blocks/aside.php' ?>
    </div>

</main>
    <div class="edit_art d-none">
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <h4>Add article</h4>
                    <form action="" method="post">
                        <label for="title">Article title </label>
                        <input type="text" name="title" id="title" class="form-control">

                        <label for="intro">Article intro </label>
                        <textarea name="intro" id="intro" class="form-control"></textarea>

                        <label for="text">Article text </label>
                        <textarea name="text" id="text" class="form-control"></textarea>

                        <div class="alert alert-danger mt-2 " id="errorBlock"></div>

                        <a  class="btn btn-success mt-1" id ='edit_article'>edit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<? require 'blocks/footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $('#delete_art').click(function () {
        let id =<?= $article->id?>;

        $.ajax({
            url: 'ajax/delete_art.php',
            type: 'POST',
            cache: false,
            data: {
                'id': id
            },
            dataType: 'html',
        })

    });
    $('#edit_art').click(function () {
        $('.edit_art').removeClass('d-none');

    });

    $('#edit_article').click(function () {  // вешаем обработчик события
        let title = $('#title').val(), // получаем данные с помощь функции val
            intro = $('#intro').val(),
            text = $('#text').val(),
            id = <?= $article->id ?>;
        console.log(id);

        $.ajax({                                      // создаем ajax запрос
            url: 'ajax/edit_article.php',
            type: 'POST',
            cache: false,
            data: {
                'title': title,
                'intro': intro,
                'text': text,
                'id': id
            },
            dataType: 'html' ,
            success: function(data) {  // в переменную дата передается любое значение из эхо
                if(data == 'Done') {
                    $('#edit_article').text('Done'); // в случае успеха на кнопке выведится done
                    $('#errorBlock').hide();  // скрывается блок с ошибкой
                    $('#edit_article').css("margin-top" , "20px");
                    document.location.href = "index.php";
                }
                else
                    $('#errorBlock').show(); //  в случае ошибки выведится блок с ошибкой
                $('#errorBlock').text(data);

            }
        });


    });

</script>
</body>
</html>