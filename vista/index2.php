
<?php
	session_start();
?>
  <title>Blog Videojuegos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: url(../img/freezer-artwork-3980.jpg);">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__shakeY">Entradas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">entradas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h1 class="card-title">Buscar entrada</h1>
            <div class="input-group">
              <input id="buscar-entrada" type="text" class="form-control float-left" placeholder="Ingrese el nombre de la entrada">
              <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
            </div>
          </div>
          <div class="card-body">
            <div id="entradas">

            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  include_once 'layouts/footer.php';
  ?>
<script src="../js/Catalogo.js" ></script>



