<?php
session_start();
if (isset($_SESSION['usr_role']) != "") {
  include_once 'layouts/header.php';
?>

  <title>Adm | Entradas</title>
  <?php
  include_once 'layouts/nav.php';
  ?>
  <!-- Modal -->
  <div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content ">
        <div class="card card-success ">
          <div class="card-header">
            <h3 class="card-title">Crear Entrada</h3>
            <button type="button" data-dismiss="modal" aria-label="close" class="close ">
              <span aria-hidden="true">&times;</span>
            </button>
            </h3>
          </div>

          <div class="card-body">
            <div class="alert alert-success text-center" id="add" style="display:none;">
              <span><i class="fas fa-check m-1"></i>guardado!!</span>
            </div>
            <div class="alert alert-danger text-center" id="noadd" style="display:none;">
              <span><i class="fas fa-times m-1"></i>Edicion deshabilitada</span>
            </div>
            <form id="form-crear-entrada" class="form-horizontal">

              <div class="form-group row">

                <div class="col-sm-12">
                  <label for="titulo" ">Titulo</label>
                  <input type=" text" id="titulo" class="form-control">
                </div>
              </div>
              <div class="form-group row">

                <div class="col-sm-12">
                  <label for="adicional"> Informacion Adicional</label>
                  <textarea class="form-control" name="" id="adicional" cols="30" rows="10"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="presentacion">Categoria</label>
                  <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%"></select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="text" id="link" class="form-control" placeholder="ID que se encuentra en el link del video de YouTube">
                  <img src="../img/Anotación 2020-07-26 172210.png" alt="" class="">
                </div>
              </div>
              <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                </form>
              </div>


        </div>
        <div class="card-footer">
          <p class="text-muted">Cuidado con ingresar datos erroneos</p>
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
            <h1>Gestion Entradas <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-primary">Crear entrada</button></h1>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion Entradas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h1 class="card-title">Buscar Entrada</h1>
            <div class="input-group">
              <input id="buscar-entrada" type="text" class="form-control float-left" placeholder="Ingrese nombre de la entrada">
              <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
            </div>
          </div>
          <div  id="entradas" class="card-body">
           
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>

    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php
  include_once 'layouts/footer.php';
  ?>

<?php

} else {
  header('Location:../index.php');
}
?>
<script src="../js/Entrada.js"></script>