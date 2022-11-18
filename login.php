<?php include("config.php");
include("banco-Usuario.php");
include("logica-usuario.php");

$usuario = buscaUsuario($conn, $_POST["email"], $_POST["senha"]);

if ($usuario == null) {
    header("Location: index.php?login=0");
} else {
    logaUsuario($usuario["email"]);
    header("Location: index.php?login=1");
}
die();
