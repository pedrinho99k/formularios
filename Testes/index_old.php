<?php require_once("./config/config.php");

session_start();

if ((isset($_SESSION['usuarioNome']))) {
} else {
    $_SESSION['loginErro'] = "Você precisa efetuar login!";
    header("Location: login.php");
}
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
    <script src="<?php echo DIRJS . 'jQuery-2.1.4.min.js' ?>"></script>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid">
            <ul class="nav justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">
                        <svg id="test" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item" id="logo">
                    <a class="nav-link" aria-current="page" href="<?php echo DIRPAGE . '/' ?>">
                        <img src="<?php echo DIRIMG . 'HR-08_2.PNG' ?>" alt="Logo HR" width="110" height="50">
                    </a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <div class="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                        <label class="dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <h8><?php echo $_SESSION['usuarioId'] . " - " . $_SESSION['usuarioNome']; ?></h8>
                        </label>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item"><?php echo $_SESSION['usuarioEmail']; ?></li>
                            <li class="dropdown-item" style="display: none;" id="cod_perfil_login"><?php echo $_SESSION['codPerfil']; ?></li>
                            <li class="dropdown-item" style="display: none;" id="cod_usuario_login"><?php echo $_SESSION['usuarioId']; ?></li>
                            <li class="dropdown-item">Perfil: <?php echo $_SESSION['descPerfil']; ?></li>
                            <li><a class="dropdown-item" href="<?php echo DIRPAGE . "/logout.php" ?>">Sair</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!--INICIO OFFCANVAS-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel"><?php echo NOMESITE ?></h5>
            <button type="button" class="btn-close text-reset" id="close-canvas" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p><a href="<?php echo DIRPAGE . "/" ?>"><button class="btn btn-primary button-global" style="width: 100%;">Início</button></a></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraFormularioQuestoes()">Novo Fomulário</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraFormularioApartirFormularioCriado()">Novo Formulário Apartir de Outro</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-usuarios" style="width: 100%;" onclick="FormCadastraUsuario()">Usuários</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-perfil" style="width: 100%;" onclick="FormCadastraPerfil()">Perfil</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-formularios" style="width: 100%;" onclick="FormCadastraFormulario()">Formulários</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraQuestoes()">Questões</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormVincularPerfisFormulario()">Vinculo de Perfis/Formulários</button></p>
            <p><button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormVincularQuestoesFormulario()">Vinculo de Questões/Formulários</button></p>

        </div>
    </div>
    <!--FIM OFFCANVAS-->
    <div class="container">
        <div class="col-md-12" id="form" style="background-color: white;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center mt-4" id="inicio">
                        <h2 class="m-2">📋 Olá, <?php echo $_SESSION['usuarioNome']; ?></h2>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <form id="form-principal">
                        <h4 class="mb-4">🧾 Formulários</h4>
                        <div class="row" id="cards">
                        </div>
                    </form>
                </div>
                <div class="row">
                    <form id="fim">
                        <hr>
                        <div class="position-relative">
                            <h4 class="position-absolute top-0 start-0">📑 Registros de Formulários</h4>
                        </div>
                        <div class="position-relative">
                            <div class=" position-absolute top-0 end-0">
                                <label class="" for="num_linhas">Nº de Linhas</label>
                                <select style="width:50px" name="num_linhas" id="num_linhas">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="100">100</option>
                                    <option value="1000">1000</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="col-md-12 mt-4" id="tabela-registros">
                            <h6 id="nome-form-pesquisa"></h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" id="cod_registro">Cód. Registro</th>
                                            <th scope="col">Formulário</th>
                                            <th scope="col" id="usuario">Cód. dos Dados</th>
                                            <th scope="col">Tipo do Registro</th>
                                            <th scope="col">Data/Hora</th>
                                            <th scope="col">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpo-tabela">

                                    </tbody>
                                </table>
                                <div class="paginacao text-center" id="paginacao">
                                </div>
                        </div>
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
    <script src="<?php echo DIRJS . 'master.js' ?>"></script>

</body>

</html>