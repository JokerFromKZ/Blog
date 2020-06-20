<!doctype html>
<html lang="ru">
<head>
    <?
    $website_title = "SIGN IN";
    require 'blocks/head.php'?>
</head>
<body>

<? require 'blocks/header.php' ?>



<main class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <?php
                if($_COOKIE['login'] == ''):
            ?>
            <h4>SIGN IN</h4>
            <form action="" method="post">

                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control">

                <label for="password">Password</label>
                <input type="password" name="pass" id="pass" class="form-control">

                <div class="alert alert-danger mt-2 " id="errorBlock"></div>

                <button type="button"  id = 'auth_user' name="button" class="btn btn-success mt-2">SIGN IN</button>
            </form>
                    <?php
                        else:
                    ?>
                        <h2><?=$_COOKIE['login']?></h2>

                    <?php
                        endif;
                    ?>
        </div>
        <? require 'blocks/aside.php' ?>
    </div>
</main>

<? require 'blocks/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $('#exit_btn').click(function () {  // вешаем обработчик события

        $.ajax({                                      // создаем ajax запрос
            url: 'ajax/exit.php',
            type: 'POST',
            cache: false,
            data: {
            },
            dataType: 'html' ,
            success: function(data) {  // в переменную дата передается любое значение из эхо
                document.location.reload(true);
            }
        });


    });


    $('#auth_user').click(function () {  // вешаем обработчик события
        let login = $('#login').val(),
            pass = $('#pass').val();

        $.ajax({                                      // создаем ajax запрос
            url: 'ajax/auth.php',
            type: 'POST',
            cache: false,
            data: {
                'login': login,
                'pass': pass
            },
            dataType: 'html' ,
            success: function(data) {  // в переменную дата передается любое значение из эхо
                if(data == 'Done') {
                    $('#auth_user').text('Done'); // в случае успеха на кнопке выведится done
                    $('#errorBlock').hide();  // скрывается блок с ошибкой
                    $('#auth_user').css("margin-top" , "20px");
                    document.location.reload(true);
                }
                else
                    $('#errorBlock').show(); //  в случае ошибки выведится блок с ошибкой
                    $('#errorBlock').text('Error');

            }
        });


    });
</script>

</body>
</html>