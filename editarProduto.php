<?php
@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {
  $product_name = $_POST['product_name'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];
  $product_supplier = $_POST['product_supplier'];
  $product_category = $_POST['product_category'];
  $product_qtde = $_POST['product_qtde'];
  $product_image = $_FILES['product_image']['name'];
  $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
  $product_image_folder = 'assets/images/' . $product_image;

  if (empty($product_name) || empty($product_description) || empty($product_price) || empty($product_supplier) || empty($product_category) || empty($product_qtde) || empty($product_image)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    // $innerJoinCategoria = "SELECT descricaoCategoria FROM produto p INNER JOIN categoria c ON p.idCategoria = c.idCategoria";
    $update = "UPDATE produto SET nomeProduto = '$product_name', descricaoProduto = '$product_description', precoProduto = '$product_price', idFornecedor = '$product_supplier', idCategoria = '$product_category', qtdeProduto = '$product_qtde', imagemProduto = '$product_image' WHERE idProduto = $id";

    $upload = mysqli_query($conn, $update);
    if ($upload) {
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
    } else {
      $message[] = 'O produto não pôde ser adicionado!';
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

        <a href="addCategoria.php" class="active">
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

        <a href="login.html">
          <span class="material-icons-sharp">logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>

    <div class="admin-product-form-container centered">
      <?php
      $select = mysqli_query($conn, "SELECT * FROM produto WHERE id = $id");
      while ($row = mysqli_fetch_assoc($select)) {

      ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <h2>Atualizar produto</h2>
          <input type="text" placeholder="Digite o nome do produto" name="product_name" value="<?php echo $row['nomeProduto'] ?>" class="box" />

          <textarea name="product_description" placeholder="Descreva o produto" value="<?php echo $row['descricaoProduto'] ?>" cols="20" rows="5" class="box"></textarea>

          <input type="number" placeholder="Digite o valor" name="product_price" value="<?php echo $row['precoProduto'] ?>" class="box" />
          <select name="product_supplier" value="<?php echo $row['idFornecedor'] ?>" class="box">
            <option>Selecione o fornecedor</option>
          </select>

          <select name="product_category" value="<?php echo $row['idCategoria'] ?>" class="box">
            <option value="product_category">Selecione a categoria</option>
          </select>

          <input type="number" placeholder="Digite a quantidade" name="product_qtde" value="<?php echo $row['qtdeProduto'] ?>" class="box" />

          <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" value="<?php echo $row['imagemProduto'] ?>" class="box" />

          <input type="submit" class="btn" name="update_product" value="Atualizar Produto" />

          <a href="addProduto.php" class="btn">Voltar</a>
        </form>
      <?php }; ?>
    </div>
  </div>

</body>

</html>