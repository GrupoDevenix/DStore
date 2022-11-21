<?php

// Carregar o Composer
require '..lib/vendor/autoload.php';

// Incluir conexao com BD
include '../config.php';

// QUERY para recuperar os registros do banco de dados
$query_clientes = mysqli_query($conn, "SELECT * FROM cliente");

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='styles/crud.css'";
$dados .= "<title>Relatório de Clientes</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar os Clientes</h1>";

// Ler os registros retornado do BD
while ($row_cliente = mysqli_fetch_assoc($query_clientes)) {
  //var_dump($row_usuario);
  extract($row_cliente);
  $dados .= "ID: $idCliente <br>";
  $dados .= "Email: $emailCliente <br>";
  $dados .= "Nome: $nomeCliente <br>";
  $dados .= "CEP: $cep <br>";
  $dados .= "Endereço: $endereco <br>";
  $dados .= "Número: $numero <br>";
  $dados .= "Bairro: $bairro <br>";
  $dados .= "Cidade: $cidade <br>";
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
