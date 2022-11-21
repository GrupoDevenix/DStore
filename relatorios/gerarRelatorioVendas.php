<?php

// Carregar o Composer
require '../vendor/autoload.php';

// Incluir conexao com BD
include '../config.php';

// QUERY para recuperar os registros do banco de dados
$query_vendas = mysqli_query($conn, "SELECT *, nomeProduto, nomeCliente, u.nome FROM venda v INNER JOIN produto p ON v.idProduto = p.idProduto INNER JOIN cliente c ON v.idCliente = c.idCliente INNER JOIN usuarios u ON v.idFuncionario = u.idFuncionario");

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='styles/crud.css'";
$dados .= "<title>Relatório de Vendas</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar as Vendas</h1>";

// Ler os registros retornado do BD
while ($row_venda = mysqli_fetch_assoc($query_vendas)) {
  //var_dump($row_usuario);
  extract($row_venda);
  $dados .= "ID: $idVenda <br>";
  $dados .= "Produto: $nomeProduto <br>";
  $dados .= "Cliente: $nomeCliente <br>";
  $dados .= "Funcionário: $nome <br>";
  $dados .= "Valor: $valorTotal <br>";
  $dados .= "Data: $data <br>";
  $dados .= "<hr>";
}

// $dados .= "<img src='http://localhost/celke/imagens/celke.jpg'><br>";
$dados .= "</body>";


// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream();
