<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--CSS-->
  <link rel="stylesheet" href="styles/login.css" />

  <!--FONT AWESOME-->
  <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

  <!-- PHP-->
  <?php include("logica-usuario.php"); ?>

  <title>Login</title>
</head>

<body>
  <!--MAIN-->
  <div class="mensagem">
    <?php if (isset($_GET["login"]) && $_GET["login"] == true) { ?>
      <?php header("Location:dashboard.php?logout=true"); ?>
    <?php } ?>
    <?php if (isset($_GET["login"]) && $_GET["login"] == false) { ?>
      <p class="alert-danger"> Usuario ou senha invalida</p>
    <?php } ?>

  </div>
  <main class="container">
    <?php if (usuarioEstaLogado()) { ?>
      <p class="text_success">Você esta logago como <?= usuarioLogado() ?>.</p>
    <?php } else { ?>

      <h1 class="logo">DStore</h1>
      <h2>Login</h2>
      <form action="login.php" method="post">
        <div class="input-field">
          <input type="email" name="email" id="username" placeholder="Enter Your Username" />
          <div class="underline"></div>
        </div>

        <div class="input-field">
          <input type="password" name="senha" id="password" placeholder="Enter Your Password" />
          <div class="underline"></div>
        </div>

        <input type="submit" value="Continue" />
      </form>

      <div class="footer">
        <span>Or Connect With Social Media</span>
        <div class="social-fields">
          <div class="social-field twitter">
            <a href="#">
              <i class="fab fa-twitter"></i>
              Cadastro
            </a>
          </div>
          <div class="social-field facebook">
            <a href="#">
              <i class="fab fa-facebook-f"></i>
              Esqueci minha senha
            </a>
          </div>
        </div>
      </div>
  </main>
<?php } ?>
</body>


</html>