<?php
@include 'config.php';


if (isset($_POST['add_category'])) {
  $category_name = $_POST['category_name'];

  if (empty($category_name)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $insert = "INSERT INTO categoria(descricaoCategoria) VALUES('$category_name')";

    $upload = mysqli_query($conn, $insert);
    if ($upload) {
      $message[] = 'Categoria cadastrada com sucesso!';
    } else {
      $message[] = 'A categoria não pôde ser cadastrada!';
    }
  }
};

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM categoria WHERE idCategoria = $id");
  header('location:addCategoria.php');
};

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--CSS-->
  <link rel="stylesheet" href="styles/crud.css" />

  <!--PHP-->
  <?php include("logica-usuario.php"); ?>

  <!--MATERIAL ICONS-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <title>Adicionar Categoria</title>
</head>

<body>
  <div class="container">
    <aside>
      <div class="top">
        <div class="logo">
          <a href="dashboard.php">
            <img src="img/logo_transparent_alt.png" alt="logo" />
          </a>
          <!-- <h2>D<span class="logo-color">STORE</span></h2> -->
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
        <h2>Adicionar nova categoria</h2>
        <input type="text" placeholder="Digite o nome da categoria" name="category_name" class="box" />

        <input type="submit" class="btn" name="add_category" value="Adicionar Categoria" />
      </form>
    </div>

    <?php
    $select = mysqli_query($conn, "SELECT * FROM categoria");
    ?>

  </div>

  <div class="product-container">
    <div class="product-display">
      <table class="product-display-table">
        <thead>
          <tr>
            <th>Nome</th>
          </tr>
        </thead>

        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
          <tr>
            <td><?php echo $row['descricaoCategoria']; ?></td>
            <td>
              <a href="editarCategoria.php?edit=<?php echo $row['idCategoria']; ?>" class="btn"> <i class="fas fa-edit"> edit </i> </a>
              <a href="addCategoria.php?delete=<?php echo $row['idCategoria']; ?>" class="btn"> <i class="fas fa-trash"> delete </i> </a>
            </td>
          </tr>
        <?php }; ?>
      </table>
    </div>
  </div>
</body>

</html>