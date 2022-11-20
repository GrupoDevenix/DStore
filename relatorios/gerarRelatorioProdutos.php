<?php

// Carregar o Composer
require '../vendor/autoload.php';

// Incluir conexao com BD
include '../config.php';

// QUERY para recuperar os registros do banco de dados
$query_produtos = mysqli_query($conn, "SELECT p.*, descricaoFornecedor, descricaoCategoria FROM produto p INNER JOIN fornecedor f ON p.idFornecedor = f.idFornecedor INNER JOIN categoria c ON p.idCategoria = c.idCategoria");

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='styles/crud.css'";
$dados .= "<title>Relatório de Produtos</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Listar os Produtos</h1>";

// Ler os registros retornado do BD
while ($row_produto = mysqli_fetch_assoc($query_produtos)) {
  //var_dump($row_usuario);
  extract($row_produto);
  $dados .= "ID: $idProduto <br>";
  $dados .= "Produto: $nomeProduto <br>";
  $dados .= "Descrição: $descricaoProduto <br>";
  $dados .= "Valor: $valorProduto <br>";
  $dados .= "Quantidade: $qtdeProduto <br>";
  $dados .= "Fornecedor: $fornecedor <br>";
  $dados .= "Categoria: $categoria <br>";
  $dados .= "Imagem: $imagem <br>";
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
