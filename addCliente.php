<?php
@include 'config.php';


if (isset($_POST['add_client'])) {
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
    $insert = "INSERT INTO cliente(emailCliente, nomeCliente, logradouro, numero, cep, bairro, cidade) VALUES('$client_email', '$client_name', '$client_address', '$client_number', '$client_cep', '$client_district', '$client_city')";

    $upload = mysqli_query($conn, $insert);
    if ($upload) {
      $message[] = 'Cliente cadastrado com sucesso!';
    } else {
      $message[] = 'O cliente não pôde ser cadastrado!';
    }
  }
};

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM cliente WHERE idCliente = $id");
  header('location:addCliente.php');
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

  <!--MATERIAL ICONS-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

  <title>Adicionar Cliente</title>
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

        <a href="login.html">
          <span class="material-icons-sharp">logout</span>
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
        <h2>Adicionar novo cliente</h2>
        <input type="email" placeholder="Digite o email do cliente" name="client_email" class="box" />

        <input type="text" placeholder="Digite o nome do cliente" name="client_name" class="box" />

        <input type="text" placeholder="Digite o CEP" name="client_cep" class="box" />

        <input type="text" placeholder="Digite o endereço" name="client_address" class="box" />

        <input type="text" placeholder="Digite o número" name="client_number" class="box" />

        <input type="text" placeholder="Digite o bairro" name="client_district" class="box" />

        <input type="text" placeholder="Digite o cidade" name="client_city" class="box" />

        <input type="submit" class="btn" name="add_client" value="Adicionar Cliente" />
      </form>
    </div>

    <?php
    $select = mysqli_query($conn, "SELECT * FROM cliente");
    ?>

  </div>

  <div class="product-container">
    <div class="product-display">
      <table class="product-display-table">
        <thead>
          <tr>
            <th>Email</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Número</th>
            <th>CEP</th>
            <th>Bairro</th>
            <th>Cidade</th>
          </tr>
        </thead>

        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
          <tr>
            <td><?php echo $row['emailCliente']; ?></td>
            <td><?php echo $row['nomeCliente']; ?></td>
            <td><?php echo $row['logradouro']; ?></td>
            <td><?php echo $row['numero']; ?></td>
            <td><?php echo $row['cep']; ?></td>
            <td><?php echo $row['bairro']; ?></td>
            <td><?php echo $row['cidade']; ?></td>
            <td>
              <a href="editarCliente.php?edit=<?php echo $row['idCliente']; ?>" class="btn"> <i class="fas fa-edit"> edit </i> </a>
              <a href="addCliente.php?delete=<?php echo $row['idCliente']; ?>" class="btn"> <i class="fas fa-trash"> delete </i> </a>
            </td>
          </tr>
        <?php }; ?>
      </table>
    </div>
  </div>
</body>

</html>