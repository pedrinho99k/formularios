<?php require_once("./config/config.php");
?>
<!doctype html lang="pt-BR">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo NOMESITE ?></title>
    <link rel="shortcut icon" href="http://hr.org/network/pics/favicon.ico">

    <!-- CSS -->
    <link href="<?php echo DIRCSS . 'main.css' ?>" rel="stylesheet">
    <link href="<?php echo DIRBOOTSTRAP . 'css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap+Condensed:wght@200;400&display=swap" rel="stylesheet">
    <script src="<?php echo DIRJS . 'jQuery-2.1.4.min.js' ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <div class=" col-md-12 d-none info">
        <input type="text" name="cod_usuario_login" id="cod_usuario_login" value="26">
        <input type="text" name="cod_form" id="cod_form" value="<?php echo $_GET['cod_form'] ?>">
    </div>
    <div class="container">
        <div class="col-md-12" id="form" style="background-color: white;">
            <div class="container-fluid">
                <div class="row">
                    <form class="mt-4" id="form-principal">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--INICIO FOOTER-->
    <div class="container-fluid" style="background-color: white;">
        <footer class="d-flex flex-wrap justify-content-between align-items-center border-top">
            <div class="container">
                <div class="col-md-4 d-flex align-items-center py-4">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <span class="text-muted">© 2022 Hospital do Rim</span>
                </div>
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </div>
        </footer>
    </div>
    <!--Modal Vizualizar-->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary d-none" id="btn-modal-vizualizacao" data-bs-toggle="modal" data-bs-target="#modal-vizualizacao">
        Modal
    </button>
    <div class="modal fade" id="modal-vizualizacao" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">🧾 Vizualização de Registro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="vizualizacao">
                        <div class="col-md-12" id="tabela-vizualizar-registros">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-none">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="<?php echo DIRBOOTSTRAP . 'js/bootstrap.bundle.min.js' ?>"></script>
    <script src="<?php echo DIRJS . 'form-sem-login.js' ?>"></script>

</body>

</html>