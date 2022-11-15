<?php
@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_category'])) {
  $category_name = $_POST['category_name'];

  if (empty($category_name)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $update = "UPDATE categoria SET descricaoCategoria = '$category_name' WHERE idCategoria = $id";

    $upload = mysqli_query($conn, $update);

    if ($upload) {
      $message[] = 'Categoria atualizada com sucesso!';
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

  <title>Editar Categoria</title>
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
        <a href="index.php">
          <span class="material-icons-sharp">grid_view</span>
          <h3>Dashboard</h3>
        </a>

        <a href="#">
          <span class="material-icons-sharp">person_outline</span>
          <h3>Clientes</h3>
        </a>

        <a href="#">
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

        <a href="#">
          <span class="material-icons-sharp">report_gmailerrorred</span>
          <h3>Relatórios</h3>
        </a>

        <a href="#">
          <span class="material-icons-sharp">settings</span>
          <h3>Configurações</h3>
        </a>

        <a href="#">
          <span class="material-icons-sharp">logout</span>
          <h3>Sair</h3>
        </a>
      </div>
    </aside>

    <div class="admin-product-form-container centered">
      <?php
      $select = mysqli_query($conn, "SELECT * FROM categoria WHERE idCategoria = $id");
      while ($row = mysqli_fetch_assoc($select)) {
      ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <h2>Atualizar categoria</h2>
          <input type="text" placeholder="Digite o nome da categoria" name="category_name" value="<?php echo $row['descricaoCategoria'] ?>" class="box" />

          <input type="submit" class="btn" name="update_category" value="Atualizar Categoria" />

          <a href="addCategoria.php" class="btn">Voltar</a>
        </form>
      <?php }; ?>
    </div>
  </div>

</body>

</html>