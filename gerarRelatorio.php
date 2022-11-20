<?php
@include 'config.php';

$select = "SELECT *, nomeProduto, nomeCliente, f.nome FROM venda v INNER JOIN produto p ON v.idProduto = p.idProduto INNER JOIN cliente c ON v.idCliente = c.idCliente INNER JOIN funcionario f ON v.idFuncionario = f.idFuncionario";

$result = $conn->prepare($select);
$result->execute();

$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
$dados .= "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";

// CSS
$dados .= "<link rel='stylesheet' href='styles/crud.css' />";

// MATERIAL ICONS
$dados .= "<link href='https://fonts.googleapis.com/icon?family=Material+Icons+Sharp' rel='stylesheet' />";

// FONT AWESOME
$dados .= "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' />";

$dados .= "<title>Gerar Relatório</title>";
$dados .= "</head>";

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  //var_dump($row);
  extract($row);
  echo "ID: $idVenda <br>";
  echo "Produto: $nomeProduto <br>";
  echo "Cliente: $nomeCliente <br>";
  echo "Funcionário: $nomeFuncionario <br>";
  echo "Valor: $valorTotal <br>";
  echo "<hr>";
}

?>



<body>
  <div class="container">
    <aside>
      <div class="top">
        <div class="logo">
          <!-- <img src="assets/images/logo.png" alt="logo" /> -->
          <h2>D<span class="logo-color">STORE</span></h2>
        </div>
        <div class="close" id="close-btn">
          <span class="material-icons-sharp">close</span>
        </div>
      </div>

      <div class="sidebar">
        <a href="dashboard.php">
          <span class="material-icons-sharp">grid_view</span>
          <h3>Dashboard</h3>
        </a>

        <a href="addCliente.php">
          <span class="material-icons-sharp">person_outline</span>
          <h3>Clientes</h3>
        </a>

        <a href="addPedido.php">
          <span class="material-icons-sharp">receipt_long</span>
          <h3>Pedidos</h3>
        </a>

        <!-- <a href="#">
          <span class="material-icons-sharp">insights</span>
          <h3>Analytics</h3>
        </a> -->

        <!-- <a href="#">
          <span class="material-icons-sharp">mail_outline</span>
          <h3>Mensagens</h3>
          <span class="message-count">26</span>
        </a> -->

        <a href="addProduto.php">
          <span class="material-icons-sharp">inventory</span>
          <h3>Produtos</h3>
        </a>

        <a href="addFornecedor.php">
          <span class="material-icons-sharp">local_shipping</span>
          <h3>Fornecedores</h3>
        </a>

        <a href="addCategoria.php">
          <span class="material-icons-sharp">
            category
          </span>
          <h3>Categorias</h3>
        </a>

        <a href="gerarRelatorio.php" class="active">
          <span class="material-icons-sharp">report_gmailerrorred</span>
          <h3>Relatórios</h3>
        </a>

        <!-- <a href="#">
          <span class="material-icons-sharp">settings</span>
          <h3>Configurações</h3>
        </a> -->

        <a href="login.html">
          <span class="material-icons-sharp">logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>


  </div>
</body>

</html>