<?php
session_start();
if (isset($_SESSION['usr_role']) != "") {
include_once 'layouts/header.php';
?>

  <title>Adm | Categorias</title>
<?php
include_once 'layouts/nav.php';
?>
 



  <!-- Modal -->
 <div class="modal fade" id="crearcategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Crear categoria</h3>
            <button type="button" data-dismiss="modal" aria-label="close" class="close ">
              <span aria-hidden="true">&times;</span>
            </button>
            </h3>
          </div>
          <div class="card-body">
          <div class="alert alert-success text-center" id="add-pre" style="display:none;">
              <span><i class="fas fa-check m-1"></i>SE agregó correctamente</span>
            </div>
            <div class="alert alert-danger text-center" id="noadd-pre" style="display:none;">
              <span><i class="fas fa-times m-1"></i>LA clasificacion ya existe</span>
            </div>
            <div class="alert alert-success text-center" id="edit-pre" style="display:none;">
              <span><i class="fas fa-check m-1"></i>SE editó correctamente</span>
            </div>
            <form id="form-crear-categoria">
              <div class="form-group">
                <label for="nombre-categoria">Nombre</label>
                <input id="nombre-categoria" type="text" class="form-control" placeholder="Ingrese nombre" required>
                <input type="hidden" id="id_editar_cat">
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestion Categorias</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion categorias</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">

                            <li class="nav-item"><a href="#categoria" class="nav-link active" data-toggle="tab">Categorias</a></li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                           
                            <div class="tab-pane active" id='categoria'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Buscar categoria <button type="button" data-toggle="modal" data-target="#crearcategoria" class="btn bg-gradient-primary btn-sm m-2">Crear categoria</button></div>
                                        <div class="input-group">
                                            <input id="buscar-categoria" type="text" class="form-control float-left" placeholder="Ingrese nombre de la categoria">
                                            <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-responsive">
                                      <table class="table table-hover text-nowrap">
                                        <thead class="table-success">
                                          <tr>
                                            <th>Acción</th>
                                            <th>categoria</th>  
                                          </tr>
                                        </thead>
                                        <tbody  class="table-active" id="categorias">

                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card footer">

                    </div>
                </div>
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


<?php

    
}else {
    header('Location:../vista/index.php');
}

?>

<script src="../js/Categoria.js"></script>