
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/Pizza-icon.png">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">

</head>


<body class="text-center">

  <div class="container">
    
    <form class="form-signin" method="POST" action="valida.php">

      <img class="mb-4" src="./img/Logo Pizzaria login.png" alt="" >

      <h2 class="form-signin-heading">Área Restrita</h2>

      <label for="inputEmail" class="sr-only">Email</label>
      <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Login" required autofocus>

      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
    </form>
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
  </div> <!-- /container -->

</body>

</html>