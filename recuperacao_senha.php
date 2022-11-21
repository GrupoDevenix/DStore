<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--CSS-->
    <link rel="stylesheet" href="styles/login.css" />

    <!-- PHP-->
    <?php include("logica-usuario.php");
    include("config.php")
    ?>

    <!--FONT AWESOME-->
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>

    <title>Recuperar Senha</title>
</head>

<body>
    <main class="container">
        <div class="logo">
            <img src="img/logo_transparent.png">
        </div>

        <h2 style="color:aliceblue">Recuperar Senha</h2>

        <?php

        ?>
        <form action="" method="post">
            <div class="input-field">
                <input type="email" name="email" id="username" placeholder="Email" required>
                <div class="underline"></div>
            </div>
            <code style="color:aliceblue">Insira o email cadastrado para receber um link para trocar a senha por email</code>
            <input class="botao" type="submit" value="Enviar" name="recuperarSenha" />
            <input type="hidden" name="env" value="form">
        </form>
        <?php
        echo verifica_dados($conn);
        ?>
        </br>
        <a href="index.php" class="linha"><span class="voltar">Voltar</span></a>
    </main>
</body>

</html>