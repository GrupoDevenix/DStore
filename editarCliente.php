<?php
@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_client'])) {
  $client_email = $_POST['client_email'];
  $client_name = $_POST['client_name'];
  $client_address = $_POST['client_address'];
  $client_number = $_POST['client_number'];
  $client_cep = $_POST['client_cep'];
  $client_district = $_POST['client_district'];
  $client_city = $_POST['client_city'];

  if (empty($client_email) || empty($client_name) || empty($client_address) || empty($client_number) || empty($client_cep) || empty($client_district) || empty($client_city)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $update = "UPDATE cliente SET emailCliente = '$client_email', nomeCliente = '$client_name', logradouro = '$client_address', numero = '$client_number', cep = '$client_cep', bairro = '$client_district', cidade = '$client_city' WHERE idCliente = $id";

    $upload = mysqli_query($conn, $update);

    if ($upload) {
      $message[] = 'Cliente atualizado com sucesso!';
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

  <title>Editar Cliente</title>
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

        <a href="addCliente.php" class="active">
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
      $select = mysqli_query($conn, "SELECT * FROM cliente WHERE idCliente = $id");
      while ($row = mysqli_fetch_assoc($select)) {
      ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
          <h2>Atualizar cliente</h2>
          <input type="email" placeholder="Digite o email do cliente" name="client_email" value="<?php echo $row['emailCliente'] ?>" class="box" />

          <input type="text" placeholder="Digite o nome do cliente" name="client_name" value="<?php echo $row['nomeCliente'] ?>" class="box" />

          <input type="text" placeholder="Digite o CEP" name="client_cep" value="<?php echo $row['cep'] ?>" class="box" />

          <input type="text" placeholder="Digite o endereço" name="client_address" value="<?php echo $row['logradouro'] ?>" class="box" />

          <input type="text" placeholder="Digite o número" name="client_number" value="<?php echo $row['numero'] ?>" class="box" />

          <input type="text" placeholder="Digite o bairro" name="client_district" value="<?php echo $row['bairro'] ?>" class="box" />

          <input type="text" placeholder="Digite o cidade" name="client_city" value="<?php echo $row['cidade'] ?>" class="box" />

          <input type="submit" class="btn" name="update_client" value="Atualizar Cliente" />

          <a href="addCliente.php" class="btn">Voltar</a>
        </form>
      <?php }; ?>
    </div>
  </div>

</body>

</html>