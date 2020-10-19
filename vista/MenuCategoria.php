
<?php
	session_start();
?>
  <title>Blog Videojuegos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
            <h1 class="card-title">CATEGORIA</h1>
         
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


<script src="../js/Desplegable.js"></script>

