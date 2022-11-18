<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!--CSS-->
  <link rel="stylesheet" href="styles/style.css" />

  <!--MATERIAL ICONS-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <title>Dashboard</title>
</head>

<body>
  <!--MAIN-->
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
        <a href="dashboard.php" class="active">
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

    <!--MAIN-->
    <main>
      <h1>Dashboard</h1>

      <div class="date">
        <input type="date" />
      </div>

      <!--INSIGHTS-->
      <div class="insights">
        <div class="sales">
          <span class="material-icons-sharp">analytics</span>
          <div class="middle">
            <div class="left">
              <h3>Total de Vendas</h3>
              <h1>$25,024</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>81%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Últimas 24 Horas</small>
        </div>

        <div class="expenses">
          <span class="material-icons-sharp">bar_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total de Despesas</h3>
              <h1>$14,160</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>62%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Últimas 24 Horas</small>
        </div>

        <div class="income">
          <span class="material-icons-sharp">stacked_line_chart</span>
          <div class="middle">
            <div class="left">
              <h3>Total de Vendas</h3>
              <h1>$10,864</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>44%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Últimas 24 Horas</small>
        </div>
      </div>

      <div class="recent-orders">
        <h2>Pedidos Recentes</h2>
        <table>
          <thead>
            <tr>
              <th>Nome do Produto</th>
              <th>Número do Produto</th>
              <th>Pagamento</th>
              <th>Envio</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <!-- <tr>
                <td>Foldable Mini Drone</td>
                <td>85631</td>
                <td>Due</td>
                <td class="warning">Pending</td>
                <td class="primary">Details</td>
              </tr> -->
          </tbody>
        </table>
        <a href="#">Mostrar Todos</a>
      </div>
    </main>

    <div class="right">
      <div class="top">
        <button id="menu-btn">
          <span class="material-icons-sharp">menu</span>
        </button>
        <div class="theme-toggler">
          <span class="material-icons-sharp active">light_mode</span>
          <span class="material-icons-sharp">dark_mode</span>
        </div>
        <div class="profile">
          <div class="info">
            <p>Olá, <b>Daniel</b></p>
            <small class="text-muted">Admin</small>
          </div>
          <div class="profile-photo">
            <img src="assets/images/profile-1.jpg" alt="" />
          </div>
        </div>
      </div>
      <div class="recent-updates">
        <h2>Atualizações Recentes</h2>
        <div class="updates">
          <div class="update">
            <div class="profile-photo">
              <img src="assets/images/profile-2.jpg" alt="" />
            </div>
            <div class="message">
              <p>
                <b>Mike Tyson</b> recebeu seu pedido Night lion tech GPS
                drone.
              </p>
              <small class="text-muted">2 Minutos Atrás</small>
            </div>
          </div>

          <div class="update">
            <div class="profile-photo">
              <img src="assets/images/profile-3.jpg" alt="" />
            </div>
            <div class="message">
              <p>
                <b>Mike Tyson</b> recebeu seu pedido Night lion tech GPS
                drone.
              </p>
              <small class="text-muted">2 Minutos Atrás</small>
            </div>
          </div>

          <div class="update">
            <div class="profile-photo">
              <img src="assets/images/profile-4.jpg" alt="" />
            </div>
            <div class="message">
              <p>
                <b>Mike Tyson</b> recebeu seu pedido Night lion tech GPS
                drone.
              </p>
              <small class="text-muted">2 Minutos Atrás</small>
            </div>
          </div>
        </div>
      </div>

      <div class="sales-analytics">
        <h2>Análise de Vendas</h2>
        <div class="item online">
          <div class="icon">
            <span class="material-icons-sharp">shopping_cart</span>
          </div>
          <div class="right">
            <div class="info">
              <h3>PEDIDOS ONLINE</h3>
              <small class="text-muted">Últimas 24 Horas</small>
            </div>
            <h5 class="success">+39%</h5>
            <h3>3849</h3>
          </div>
        </div>

        <div class="item offline">
          <div class="icon">
            <span class="material-icons-sharp">local_mall</span>
          </div>
          <div class="right">
            <div class="info">
              <h3>PEDIDOS OFFLINE</h3>
              <small class="text-muted">Últimas 24 Horas</small>
            </div>
            <h5 class="danger">-17%</h5>
            <h3>1100</h3>
          </div>
        </div>

        <div class="item customers">
          <div class="icon">
            <span class="material-icons-sharp">person</span>
          </div>
          <div class="right">
            <div class="info">
              <h3>NOVOS CLIENTES</h3>
              <small class="text-muted">Últimas 24 Horas</small>
            </div>
            <h5 class="success">+25%</h5>
            <h3>849</h3>
          </div>
        </div>
        <!-- <div class="item add-product">
          <span class="material-icons-sharp">add</span>
          <h3>Adicionar Produto</h3>
        </div> -->
      </div>
    </div>
  </div>

  <script src="js/orders.js"></script>
  <script src="js/index.js"></script>
</body>

</html>