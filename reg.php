<!doctype html>
<html lang="ru">
<head>
    <?
    $website_title = "SIGN UP";
    require 'blocks/head.php'?>
</head>
<body>

<? require 'blocks/header.php' ?>



<main class="container mt-5">
    <div class="row">
        <div class="col-md-8 mb-3">
            <h4>SIGN UP</h4>
            <form action="" method="post">
                <label for="username">Your name</label>
                <input type="text" name="username" id="username" class="form-control">

                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control">

                <label for="login">Login</label>
                <input type="text" name="login" id="login" class="form-control">

                <label for="password">Password</label>
                <input type="password" name="pass" id="pass" class="form-control">

                <div class="alert alert-danger mt-2 " id="errorBlock"></div>

                <button type="button"  id = 'reg_user' name="button" class="btn btn-success mt-2">SIGN UP</button>
            </form>
        </div>
        <? require 'blocks/aside.php' ?>
    </div>
</main>

<? require 'blocks/footer.php' ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $('#reg_user').click(function () {  // вешаем обработчик события
        let name = $('#username').val(), // получаем данные с помощь функции val
            email = $('#email').val(),
            login = $('#login').val(),
            pass = $('#pass').val();

        $.ajax({                                      // создаем ajax запрос
            url: 'ajax/reg.php',
            type: 'POST',
            cache: false,
            data: {
                'username': name,
                'email': email,
                'login': login,
                'pass': pass
            },
            dataType: 'html' ,
            success: function(data) {  // в переменную дата передается любое значение из эхо
                if(data == 'Done') {
                    $('#reg_user').text('Done'); // в случае успеха на кнопке выведится done
                    $('#errorBlock').hide();  // скрывается блок с ошибкой
                    $('#reg_user').css("margin-top" , "20px");
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