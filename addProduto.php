<?php
@include 'config.php';


if (isset($_POST['add_product'])) {
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
    $insert = "INSERT INTO produto(nomeProduto, descricaoProduto, precoProduto, idFornecedor, idCategoria, qtdeProduto, imagemProduto) VALUES ('$product_name', '$product_description', '$product_price', '$product_supplier', '$product_category', '$product_qtde', '$product_image')";

    $upload = mysqli_query($conn, $insert);
    if ($upload) {
      move_uploaded_file($product_image_tmp_name, $product_image_folder);
      $message[] = 'Produto adicionado com sucesso!';
    } else {
      $message[] = 'O produto não pôde ser adicionado!';
    }
  }
};

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM produto WHERE idProduto = $id");
  header('location:addProduto.php');
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--CSS-->
  <link rel="stylesheet" href="styles/crudProduto.css" />

  <!--PHP-->
  <?php include("logica-usuario.php"); ?>

  <!--MATERIAL ICONS-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <title>Adicionar Produto</title>
</head>

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

        <a href="addProduto.php" class="active">
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
    <div class="admin-product-form-container">
      <?php
      if (isset($message)) {
        foreach ($message as $message) {
          echo '<span class="message">' . $message . '</span>';
        }
      }
      ?>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h2>Adicionar novo produto</h2>
        <input type="text" placeholder="Digite o nome do produto" name="product_name" class="box" />

        <textarea name="product_description" placeholder="Descreva o produto" cols="20" rows="5" class="box"></textarea>

        <input type="number" placeholder="Digite o valor" name="product_price" class="box" />

        <input type="number" placeholder="Digite a quantidade" name="product_qtde" class="box" />

        <?php
        $selectFornecedor = mysqli_query($conn, "SELECT f.* FROM fornecedor f");
        $selectCategoria = mysqli_query($conn, "SELECT c.* FROM categoria c");
        ?>
        <select name="product_supplier" class="box">
          <option selected>Selecione o fornecedor</option>
          <?php while ($row = mysqli_fetch_assoc($selectFornecedor)) { ?>
            <option name="product_supplier" value="<?php echo $row['idFornecedor'] ?>"><?php echo $row['descricaoFornecedor']; ?></option>
          <?php }; ?>
        </select>

        <select name="product_category" class="box">
          <option selected>Selecione a categoria</option>
          <?php while ($row = mysqli_fetch_assoc($selectCategoria)) { ?>
            <option name="product_category" value="<?php echo $row['idCategoria'] ?>"><?php echo $row['descricaoCategoria']; ?></option>
          <?php }; ?>
        </select>


        <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" />

        <input type="submit" class="btn" name="add_product" value="Adicionar Produto" />

        <!-- <a href="relatorios/gerarRelatorioProdutos.php">Emitir relatório</a> -->

      </form>
      <div class="product-container">
        <div class="product-display">
          <table class="product-display-table">
            <thead>
              <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Ação</th>
              </tr>
            </thead>

            <?php
            $select = mysqli_query($conn, "SELECT *, descricaoFornecedor, descricaoCategoria FROM produto p INNER JOIN fornecedor f ON p.idFornecedor = f.idFornecedor INNER JOIN categoria c ON p.idCategoria = c.idCategoria");
            ?>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
              <tr>
                <td><img src="assets/images/<?php echo $row['imagemProduto']; ?>" height="100" alt=""></td>
                <td><?php echo $row['nomeProduto']; ?></td>
                <td><?php echo $row['precoProduto']; ?></td>
                <td><?php echo $row['qtdeProduto']; ?></td>
                <td><?php echo $row['descricaoFornecedor']; ?></td>
                <td><?php echo $row['descricaoCategoria']; ?></td>
                <td>
                  <a href="editarProduto.php?edit=<?php echo $row['idProduto']; ?>" class="btn"> <i class="fas fa-edit"> Editar </i> </a>
                  <a href="addProduto.php?delete=<?php echo $row['idProduto']; ?>" class="btn"> <i class="fas fa-trash"> Excluir </i> </a>
                </td>
              </tr>
            <?php }; ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>