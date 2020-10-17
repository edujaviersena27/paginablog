<?php
session_start();
if (isset($_SESSION['usr_role']) != "") {
  include_once 'layouts/header.php';
?>
  <title>Adm | Editar Datos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>
<!-- Modal -->
<div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmar accion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="avatar3" src="../img/5f3ee7e56adca-avatar04.png" class="profile-user-img img-fluid img-circle">
          </div>
          <div class="text-center">
              <b>
                <?php
                    echo $_SESSION['nombre_us'];
                ?>
              </b>
          </div>
          <span>Necesitamos su contraseña para continuar</span>
          <div class="alert alert-success text-center" id="confirmado" style="display:none;">
                    <span><i class="fas fa-check m-1"></i>Se modificó al usuario</span>
                  </div>
                  <div class="alert alert-danger text-center" id="rechazado" style="display:none;">
                    <span><i class="fas fa-times m-1"></i>Contraseña incorrecta</span>
                  </div>
          <form id="form-confirmar">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input id="oldpass" type="password" class="form-control" placeholder="Ingrese clave actual">
                <input type="hidden" id="id_user">
                <input type="hidden" id="funcion">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn bg-gradient-primary">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Crear usuario</h3>
            <button type="button" data-dismiss="modal" aria-label="close" class="close ">
              <span aria-hidden="true">&times;</span>
            </button>
            </h3>
          </div>
          <div class="card-body">
            <div class="alert alert-success text-center" id="add" style="display:none;">
              <span><i class="fas fa-check m-1"></i>Se agregó correctamente</span>
            </div>
            <div class="alert alert-success text-center" id="edit" style="display:none;">
              <span><i class="fas fa-check m-1"></i>Se editó correctamente</span>
            </div>
            <div class="alert alert-danger text-center" id="noadd" style="display:none;">
              <span><i class="fas fa-times m-1"></i>El dni ya existe en otro usuario</span>
            </div>
            <form id="form-crear">
              <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre completo" required>
                <input type="hidden" id="id_editar_user">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="text" class="form-control" placeholder="Ingrese email" required>
              </div>
              <div class="form-group">
                <label for="activar">Activar</label>
                <input id="activar" type="text" class="form-control" placeholder="Ingrese 1=activo 0=inactivo" required>
              </div>
              <div class="form-group">
                <label for="rol">Rol  de Usuario</label>
                <input id="rol" type="text" class="form-control" placeholder="Ingrese rol de usuario 1=tecnico 2=administrador" required>
              </div>
              <div class="form-group">
                <label for="pass">Contraseña</label>
                <input id="pass" type="password" class="form-control" placeholder="Ingrese contraseña" required>
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
            <h1>Gestion Usuarios <button id="button-crear" type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary">Crear usuario</button></h1>
  
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion usuario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
            <h1 class="card-title">Buscar usuario</h1>
            <div class="input-group">
              <input id="buscar" type="text" class="form-control float-left" placeholder="Ingrese nombre de usuario">
              <div class="input-group-append"><button class="btn btn-default"><i class="fas fa-search"></i></button></div>
            </div>
          </div>
          <div class="card-body">
            <div id="usuarios" class="row d-flex align-items-stretch">

            </div>
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
<script src="../js/Gestion_usuario.js"></script>