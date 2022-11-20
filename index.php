<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--CSS-->
  <link rel="stylesheet" href="styles/login.css" />

  <!-- PHP-->
  <?php include("logica-usuario.php"); ?>

  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

  <title>Login</title>
</head>

<body>
  <!--MAIN-->

  <div class="mensagem">

    <?php if (isset($_GET["login"]) && $_GET["login"] == true) { ?>
      <?php header("Location:dashboard.php?logout=true"); ?>
    <?php } ?>

    <?php if (isset($_GET["logout"]) && $_GET["logout"] == true) { ?>
      <p class="alert-sucess"> Usuario deslogado com sucesso</p>
    <?php } ?>
  </div>
  <main class="container">
    <?php if (usuarioEstaLogado()) { ?>
      <?php header("Location:dashboard.php?logout=true"); ?>
      </p>
    <?php } else { ?>
      <div class="logo">
        <img src="img/logo_transparent.png">
        <!--<h1 class=" logo" style="color:aliceblue">DStore</h1>-->
      </div>
      <?php if (isset($_SESSION["danger"])) { ?>
        <p class="alert-danger"> <?= $_SESSION["danger"] ?></a>

          <?php
          unset($_SESSION["danger"]);
          ?>
        <?php } ?>

        <h2 style="color:aliceblue">Login</h2>

        <form action="login.php" method="post">
          <div class="input-field">
            <input type="email" name="email" id="username" placeholder="Email" />
            <div class="underline"></div>
          </div>

          <div class="input-field">
            <input type="password" name="senha" id="password" placeholder="Senha" />
            <div class="underline"></div>
          </div>

          <input class="botao" type="submit" value="Continue" />
        </form>
        <br>
        <a href="#" class="linha"><span class="es">Esqueci minha senha</span></a>
  </main>
<?php } ?>
</body>

</html>