<?php
if($_COOKIE['login'] == ''){
    header('location: reg.php');
    exit;
}
?>

<!doctype html>
<html lang="ru">
<head>
    <?
    $website_title = "ADD ARTICLE";
    require 'blocks/head.php'?>
</head>
<body>

<? require 'blocks/header.php' ?>



<main class="container mt-5">
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

                <button type="button"  id = 'article_send' name="button" class="btn btn-success mt-2">Add</button>
            </form>
        </div>
        <? require 'blocks/aside.php' ?>
    </div>
</main>

<? require 'blocks/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $('#article_send').click(function () {  // вешаем обработчик события
        let title = $('#title').val(), // получаем данные с помощь функции val
            intro = $('#intro').val(),
            text = $('#text').val();

        $.ajax({                                      // создаем ajax запрос
            url: 'ajax/add_article.php',
            type: 'POST',
            cache: false,
            data: {
                'title': title,
                'intro': intro,
                'text': text
            },
            dataType: 'html' ,
            success: function(data) {  // в переменную дата передается любое значение из эхо
                if(data == 'Done') {
                    $('#article_send').text('Done'); // в случае успеха на кнопке выведится done
                    $('#errorBlock').hide();  // скрывается блок с ошибкой
                    $('#article_send').css("margin-top" , "20px");
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