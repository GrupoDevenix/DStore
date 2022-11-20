<?php
@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_order'])) {
  $order_product = $_POST['order_product'];
  $order_client = $_POST['order_client'];
  $order_employee = $_POST['order_employee'];
  $order_price = $_POST['order_price'];
  $order_date = $_POST['order_date'];

  if (empty($order_product) || empty($order_client) || empty($order_employee) || empty($order_price) || empty($order_date)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $update = "UPDATE venda SET idProduto = '$order_product', idCliente = '$order_client', idFuncionario = '$order_employee', valorTotal = '$order_price', data = '$order_date' WHERE idVenda = $id";

    $upload = mysqli_query($conn, $update);
    if ($upload) {
      $message[] = 'Pedido alterado com sucesso!';
    } else {
      $message[] = 'O pedido não pôde ser alterado!';
    }
  }
};
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--CSS-->
  <link rel="stylesheet" href="styles/crud.css" />

  <!--PHP-->
  <?php include("logica-usuario.php"); ?>

  <!--MATERIAL ICONS-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <title>Editar Produto</title>
</head>

<body>
  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      echo '<span class="message">' . $message . '</span>';
    }
  }
  ?>
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

        <a href="addPedido.php" class="active">
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

        <a href="gerarRelatorio.php">
          <span class="material-icons-sharp">report_gmailerrorred</span>
          <h3>Relatórios</h3>
        </a>

        <!-- <a href="#">
          <span class="material-icons-sharp">settings</span>
          <h3>Configurações</h3>
        </a> -->

        <a href="index.php">
          <span class="material-icons-sharp"><?php logout() ?>logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>

    <div class="admin-product-form-container centered">
      <?php
      $select = mysqli_query($conn, "SELECT * FROM venda WHERE idVenda = $id");
      while ($row = mysqli_fetch_assoc($select)) {

      ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <h2>Alterar Venda</h2>
          <?php
          $selectProduto = mysqli_query($conn, "SELECT p.* FROM produto p GROUP BY nomeProduto");
          $selectFuncionario = mysqli_query($conn, "SELECT u.* FROM usuarios u GROUP BY nome");
          $selectCliente = mysqli_query($conn, "SELECT c.* FROM cliente c GROUP BY nomeCliente");
          ?>

          <select name="order_product" class="box">
            <option>Selecione o produto</option>
            <?php while ($row = mysqli_fetch_assoc($selectProduto)) { ?>
              <option name="product_supplier" selected value="<?php echo $row['idProduto'] ?>"><?php echo $row['nomeProduto']; ?></option>
            <?php }; ?>
          </select>

          <select name="order_employee" class="box">
            <option>Selecione o funcionário</option>
            <?php while ($row = mysqli_fetch_assoc($selectFuncionario)) { ?>
              <option name="order_employee" selected value="<?php echo $row['idFuncionario'] ?>"><?php echo $row['nome']; ?></option>
            <?php }; ?>
          </select>

          <select name="order_client" class="box">
            <option>Selecione o cliente</option>
            <?php while ($row = mysqli_fetch_assoc($selectCliente)) { ?>
              <option name="order_client" selected value="<?php echo $row['idCliente'] ?>"><?php echo $row['nomeCliente']; ?></option>
            <?php }; ?>
          </select>

          <input type="number" placeholder="Digite o valor total" name="order_price" class="box" value="<?php echo $row['valorTotal'] ?>" />

          <input type="date" name="order_date" class="box" value="<?php echo $row['data'] ?>" />

          <input type="submit" class="btn" name="update_order" value="Editar Venda" />
        </form>
      <?php }; ?>
    </div>
  </div>

</body>

</html>