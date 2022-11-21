<?php include("config.php");
include("logica-usuario.php");

$usuario = buscaUsuario($conn, $_POST["email"], $_POST["senha"]);

if ($usuario == null) {
    $_SESSION["danger"] = "Usuario ou senha invalida.";
    header("Location: index.php");
} else {
    logaUsuario($usuario["email"]);
    header("Location: index.php");
}
die();
