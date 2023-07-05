<?php
session_start();
require_once("./config/config.php");
if ((isset($_SESSION['usuarioNome']))) {
    header("Location: index.php" );
} else {
    
}
?>
<!doctype html lang="pt-BR">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo NOMESITE ?> Login</title>
    <link rel="shortcut icon" href="http://hr.org/network/pics/favicon.ico">

    <!-- CSS -->
    <link href="<?php echo DIRCSS . '/main.css' ?>" rel="stylesheet">
    <link href="<?php echo DIRBOOTSTRAP . '/css/bootstrap.min.css' ?>" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row secao">
            <div class="col-md-6 secao-1 text-center">
                <img id="login" src="<?php echo DIRIMG . 'login.png' ?>" alt="" width="420px" height="420px">
            </div>
            <div class="col-md-6 secao-2">
                <div class="form-signin text-center">
                    <form method="POST" action="valida.php">
                        <img id="person" class="mb-4" src="<?php echo DIRIMG . 'person.svg' ?>" alt="" width="100" height="100" style="font-weight: 500;">
                        <h1 class="h3 mb-3 fw-normal">Entrar</h1>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" name="login">
                            <label for="floatingInput">Login:</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" name="senha">
                            <label for="floatingPassword">Senha:</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
                        <p class="text-center text-danger">
                            <?php if (isset($_SESSION['loginErro'])) {
                                echo $_SESSION['loginErro'];
                                unset($_SESSION['loginErro']);
                            } ?>
                        </p>
                        <p class="text-center text-success">
                            <?php
                            if (isset($_SESSION['logindeslogado'])) {
                                echo $_SESSION['logindeslogado'];
                                unset($_SESSION['logindeslogado']);
                            }
                            ?>
                        </p>
                        <p class="mt-5 mb-3 text-muted">© 2022-2022</p>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer">
            <footer class="d-flex py-3 my-4 border-top">
                <a href="/" class="d-flex  text-decoration-none">
                    <img src="<?php echo DIRIMG . '/HR-08_2.png' ?>" alt="" width="110" height="50">
                </a>
                <p class="ms-auto text-muted">© 2022 Hospital do Rim</p>
            </footer>
        </div>

    </div>
    <script src="<?php echo DIRJS . '/jQuery-2.1.4.min.js' ?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?php echo DIRBOOTSTRAP . '/js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo DIRJS . '/master.js' ?>"></script>
</body>

</html>