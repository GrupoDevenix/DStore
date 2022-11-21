<?php
@include 'config.php';


if (isset($_POST['add_user'])) {
  $user_email = $_POST['user_email'];
  $user_password = md5($_POST['user_password']);
  $user_name = $_POST['user_name'];
  $user_cpf = $_POST['user_cpf'];

  if (empty($user_email) || empty($user_password) || empty($user_name) || empty($user_cpf)) {
    $message[] = 'Preencha todos os campos!';
  } else {
    $insert = "INSERT INTO usuarios(email, senha, nome, cpf) VALUES('$user_email', '$user_password', '$user_name', '$user_cpf')";

    $upload = mysqli_query($conn, $insert);
    if ($upload) {
      $message[] = 'Usuário cadastrado com sucesso!';
    } else {
      $message[] = 'O usuário não pôde ser cadastrado!';
    }
  }
};

// if (isset($_GET['delete'])) {
//   $id = $_GET['delete'];
//   mysqli_query($conn, "DELETE FROM usuarios WHERE idFuncionario = $id");
//   header('location:addUsuario.php');
// };

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

  <title>Cadastro de Usuário</title>
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

        <a href="addCategoria.php">
          <span class="material-icons-sharp">
            category
          </span>
          <h3>Categorias</h3>
        </a>

        <a href="addUsuario.php" class="active">
          <span class="material-icons-sharp">
            person
          </span>
          <h3>Adicionar Usuarios</h3>
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
        <h2>Cadastrar usuário</h2>
        <input type="email" placeholder="Digite o email do usuário" name="user_email" class="box" type="email" required />

        <input type="password" placeholder="Digite a senha" name="user_password" class="box" required />

        <input type="text" placeholder="Digite o nome" name="user_name" class="box" required />

        <input type="text" placeholder="Digite o CPF" name="user_cpf" class="box" required />

        <input type="submit" class="btn" name="add_user" value="Cadastrar" />

        <a href="index.php">Voltar</a>

        <!-- <a href="relatorios/gerarRelatorioClientes.php">Emitir relatório</a> -->
      </form>

      <?php
      $select = mysqli_query($conn, "SELECT * FROM usuarios");
      ?>

      <!-- <div class="product-container">
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
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['senha']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['cpf']; ?></td>
                <td>
                  <a href="editarCliente.php?edit=<?php echo $row['idCliente']; ?>" class="btn"> <i class="fas fa-edit"> edit </i> </a>
                  <a href="addCliente.php?delete=<?php echo $row['idCliente']; ?>" class="btn"> <i class="fas fa-trash"> delete </i> </a>
                </td>
              </tr>
            <?php }; ?>
          </table>
        </div>
      </div> -->
    </div>


  </div>

</body>

</html>