<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm" wfd-id="49">
    <h5 class="my-0 mr-md-auto font-weight-normal">BLOG</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <!--        <a class="p-2 text-dark" href="#">Support</a>-->
    </nav>
    <a class="p-2 text-dark" href="index.php">Home</a>
    <?php
    if($_COOKIE['login'] != '') {
        echo "<a class=\"p-2 text-dark\" href=\"article.php\">Add article</a>";
    }
    ?>

    <?php
    if($_COOKIE['login'] == ''):
    ?>
    <a class="btn btn-outline-primary mr-2 mb-2 " href="auth.php">Sign in </a>
    <a class="btn btn-outline-primary mb-2" href="reg.php">Sign up</a>
    <?php else: ?>
    <a class="btn btn-outline-primary ml-4 mb-2 mr-4" href = 'auth.php'>User</a>
        <buttom class="btn btn-danger mb-2"  id = 'exit_btn'>EXIT</buttom>
    <?php endif ?>
</div>