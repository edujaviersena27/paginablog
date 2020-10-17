<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="../img/logo2.png" type="image/png">
<link rel="stylesheet" href="../css/animate.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/compra.css">
<link rel="stylesheet" href="../css/datatables.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="../css/adminlte.min.css">
<!-- sweetalert2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<!-- sweetalert2 -->
<link rel="stylesheet" href="../css/sweetalert2.css">
<script src="https://kit.fontawesome.com/f278349f1b.js" crossorigin="anonymous"></script>
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>

        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <font style="vertical-align: inherit;">
              <font style="vertical-align: inherit;">Categorias</font>
            </font>
          </a>
          <ul id="categoria" aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

          </ul>
        </li>
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Buscar">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

      </ul>



      <!-- Right navbar links -->

      <ul class="navbar-nav ml-auto">
        <?php if (isset($_SESSION['usr_role'])) { ?>
          <li class="mr-4">
            <p class="navbar-text">Logueado como <i class="btn btn-danger btn-xs"><b><?php echo $_SESSION['usr_name']; ?></b></i></p>
          </li>
          <li class="mr-2 mt-2"><a href="logout.php">Log Out</a></li>
        <?php } else { ?>
          <li class="mr-2"><a href="login.php">Login</a></li>
          <li><a href="register.php">Registro</a></li>
        <?php } ?>
      </ul>
      <!--
      <ul class="navbar-nav ml-auto">
        <a href="../controlador/Logout.php">Cerrar Sesión</a>

      </ul>-->


    </nav>
    <!-- /.navbar -->



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <?php

      if (isset($_SESSION['usr_role']) != "") {

      ?>
        <!-- Brand Logo -->
        <a href="../vista/index2.php" class="brand-link">
          <img src="../img/logo2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Home</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img id="avatar4" src="../img/empleado.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">
                <?php
                echo $_SESSION['usr_name'];

                ?>
              </a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->


              <li class="nav-header">USUARIO</li>


              <li id="gestion_usuario" class="nav-item">
                <a href="../vista/adm_usuario.php" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Gestión usuario
                  </p>
                </a>
              </li>


              <li class="nav-header">ENTRADAS</li>

              <li class="nav-item">
                <a href="../vista/adm_entradas.php" class="nav-link">
                  <i class="nav-icon fas fa-user-cog"></i>
                  <p>
                    Gestión Entradas
                  </p>
                </a>
              </li>

              <li class="nav-header">CATEGORIAS</li>

              <li class="nav-item">
                <a href="../vista/adm_categorias.php" class="nav-link">
                  <i class="fas fa-dice"></i>
                  <p>
                    Gestión categoria
                  </p>
                </a>
              </li>



            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        <?php
      }
        ?>

        <!-- /.sidebar -->
    </aside>