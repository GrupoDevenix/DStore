<?php include("config.php");
include("banco-Usuario.php");
include("logica-usuario.php");

$funcionario = buscaUsuario($conn, $_POST["email"], $_POST["senha"]);

if ($funcionario == null) {
    $_SESSION["danger"] = "Usuario ou senha invalida.";
    header("Location: index.php");
} else {
    logaUsuario($funcionario["email"]);
    header("Location: index.php");
}
die();
