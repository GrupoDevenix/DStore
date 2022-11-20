<?php
function buscaUsuario($conn, $email, $senha)
{
    $senhaMd5 = md5($senha);
    $query = "select * from funcionario where email='{$email}' and senha='{$senhaMd5}'";
    $resultado = mysqli_query($conn, $query);
    $funcionario = mysqli_fetch_assoc($resultado);
    return $funcionario;
}
