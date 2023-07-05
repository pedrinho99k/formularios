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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap+Condensed:wght@200;400&display=swap" rel="stylesheet">
    <script src="<?php echo DIRJS . 'jQuery-2.1.4.min.js' ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">

            <!-- Logo -->
            <a class="nav-brand me-4 P-4" aria-current="page" href="<?php echo DIRPAGE . '/' ?>">
                <img src="<?php echo DIRIMG . 'HR LOGO.PNG' ?>" alt="Logo HR" width="115" height="30">
            </a>

            <!-- Toggler(botão mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarCollapse">

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-x"></i>
                </button>

                <!-- Navegação -->
                <ul class="navbar-nav ms-auto">
                    <!-- Início -->
                    <li class="nav-item dropdown button-global">
                        <a class="nav-link" href="<?php echo DIRPAGE . "/" ?>">
                            Início
                        </a>
                    </li>
                    <!-- Avaliações -->
                    <li class="nav-item dropdown button-admin">
                        <a class="nav-link dropdown-toggle" id="navbarLandings" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Avaliações
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin button-gestao" id="btn-cadastro-formularios" style="width: 100%;" onclick="FormCadastrarAvaliacao()">
                                    Formulários de Avaliações
                                </button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraAvaliacaoQuestoes()">
                                    Nova Avaliação
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!-- Formulários -->
                    <li class="nav-item dropdown button-admin">
                        <a class="nav-link dropdown-toggle" id="navbarLandings" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Formulários
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin button-gestao" id="btn-cadastro-formularios" style="width: 100%;" onclick="FormCadastraFormulario()">
                                    Formulários
                                </button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraFormularioQuestoes()">
                                    Novo Fomulário
                                </button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraFormularioApartirFormularioCriado()">
                                    Novo Formulário Apartir de Outro
                                </button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormCadastraQuestoes()">Questões</button>
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!-- Usuários -->
                    <li class="nav-item dropdown button-admin">
                        <a class="nav-link dropdown-toggle" id="navbarLandings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Usuários
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-usuarios" style="width: 100%;" onclick="FormCadastraUsuario()">Usuários</button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-perfil" style="width: 100%;" onclick="FormCadastraPerfil()">Perfil</button>
                            </li>
                        </ul>

                    </li>
                    <!-- Vinculos -->
                    <li class="nav-item dropdown button-admin">
                        <a class="nav-link dropdown-toggle" id="navbarPages" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Vinculos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormVincularPerfisFormulario()">Vinculo de Perfis/Formulários</button>
                            </li>
                            <li class="dropdown-item">
                                <button class="btn btn-primary button-prin button-admin" id="btn-cadastro-questoes" style="width: 100%;" onclick="FormVincularQuestoesFormulario()">Vinculo de Questões/Formulários</button>
                            </li>
                        </ul>
                    </li>
                    <!-- Documentação -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDocumentation" data-bs-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                            Documentação
                        </a>
                        <div class="dropdown-menu dropdown-menu-md" aria-labelledby="navbarDocumentation">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item">
                                    HR Formulários
                                </a>
                                <a class="list-group-item">
                                    Versão 1.0.0
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- Conta Usuário -->
                    <li class="nav-item dropdown">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn" id="btn-conta" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu" id="drop-conta" style="width: 300px;" aria-labelledby="dropdownMenuButton1">
                                <li class="dropdown-item">
                                    <div class="row">
                                        <label for="staticEmail" class="col-2">Nome:</label>
                                        <div class="col-10">
                                            <?php echo $_SESSION['usuarioNome']; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="row">
                                        <label for="staticEmail" class="col-2">Email:</label>
                                        <div class="col-10">
                                            <?php echo $_SESSION['usuarioEmail']; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-item">
                                    <div class="row">
                                        <label for="staticEmail" class="col-2">Perfil:</label>
                                        <div class="col-10">
                                            <?php echo $_SESSION['descPerfil']; ?>
                                        </div>
                                    </div>
                                </li>

                                <li class="dropdown-item d-none" id="cod_perfil_login"><?php echo $_SESSION['codPerfil']; ?></li>
                                <li class="dropdown-item d-none" id="cod_usuario_login"><?php echo $_SESSION['usuarioId']; ?></li>
                            </ul>
                        </div>
                    </li>
                    <!-- SAIR -->
                    <li class="nav-item">
                        <a class="dropdown-item" href="<?php echo DIRPAGE . "/logout.php" ?>">Sair
                            <svg title="Sair" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar" style="background-color: #86e4f7; color: white; ">
        <div class="container-fluid">
            <div class="col-md-12 text-center" id="inicio">
                <h4 class="m-2" style="text-shadow: 0.1em 0.1em 0.2em black">📋 Olá, <?php echo $_SESSION['usuarioNome']; ?></h4>
            </div>
        </div>
        </div>
    </nav>
    <div class="container-fluid" id="principal">
        <div class="col-md-12" id="form" style="background-color: white;">
            <div class="container-fluid">
                <div class="row">
                    <form class="mt-4" id="form-principal">
                        <h4 class="mb-4">🧾 Formulários</h4>
                        <div class="d-flex align-content-stretch flex-wrap" id="cards">
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