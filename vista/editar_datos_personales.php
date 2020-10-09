<?php
session_start();
if(isset($_SESSION['usr_role']) != "") {
  include_once 'layouts/header.php';
?>

  <title>Adm | Editar Datos</title>
  <?php
  include_once 'layouts/nav.php';
  ?>
 
  <!-- Modal -->
  <div class="animate__animated animate__bounceInDown modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="avatar3" src="../img/empleado.png" class="profile-user-img img-fluid img-circle">
          </div>
          <div class="text-center">
              <b>
                <?php
                   echo $_SESSION['usr_name'];
                ?>
              </b>
          </div>
          <div class="alert alert-success text-center" id="update" style="display:none;">
                    <span><i class="fas fa-check m-1"></i>Contraseña Guardada</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noupdate" style="display:none;">
                    <span><i class="fas fa-times m-1"></i>Contraseña incorrecta</span>
                  </div>
          <form id="form-pass">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input id="oldpass" type="password" class="form-control" placeholder="Ingrese clave actual">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input id="newpass" type="password" class="form-control" placeholder="Ingrese nueva clave">
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

   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos Personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/index.php">Home</a></li>
              <li class="breadcrumb-item active">Datos Personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="card card-success card-outline">
                <div class="card-body box-profile">
               
                  <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
                  <?php
                   echo "<h4>".$_SESSION['usr_name']."</h4>";
                ?>
                 
                    <button class="btn btn-block btn-outline-warning btn-sm" data-toggle="modal" data-target="#cambiocontra">Cambiar Contraseña</button>
                  </ul>

                </div>
              </div>
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Sobre Mi</h3>
                </div>
                <div class="card-body">
                  
                  <strong style="color:#0B7300">
                    <i class="fas fa-map-marker-alt mr-1"></i>Nombre completo
                  </strong>
                  <p id="residencia_us" class="text-muted">4354564</p>
                  <strong style="color:#0B7300">
                    <i class="fas fa-at mr-1"></i>Correo
                  </strong>
                  <p id="correo_us" class="text-muted">4354564</p>
                  <strong style="color:#0B7300">
                    <i class="fas fa-smile-wink mr-1"></i>Sexo
                  </strong>
                  <p id="sexo_us" class="text-muted">4354564</p>
                  <strong style="color:#0B7300">
                    <i class="fas fa-pencil-alt mr-1"></i>Informacion sobre mi
                  </strong>
                  <p id="adicional_us" class="text-muted">4354564</p>
                  <button class="edit btn btn-block bg-gradient-danger">Editar</button>

                </div>
                <div class="card-footer">
                  <p class="text-muted">click si desea editar</p>

                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Editar Datos Personales</h3>

                </div>
                <div class="card-body">
                  <div class="alert alert-success text-center" id="editado" style="display:none;">
                    <span><i class="fas fa-check m-1"></i>Editado</span>
                  </div>
                  <div class="alert alert-danger text-center" id="noeditado" style="display:none;">
                    <span><i class="fas fa-times m-1"></i>Edicion deshabilitada</span>
                  </div>
                  <form id="form-usuario" class="form-horizontal">
                   
                    <div class="form-group row">
                      <label for="residencia" class="col-sm-2 col-form-label">Nombre Completo</label>
                      <div class="col-sm-10">
                        <input type="text" id="residencia" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                      <div class="col-sm-10">
                        <input type="text" id="correo" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                      <div class="col-sm-10">
                        <input type="text" id="sexo" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="adicional" class="col-sm-2 col-form-label"> Informacion Adicional</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="" id="adicional" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10 float-right">
                        <button class="btn btn-block btn-outline-success">Guardar</button>
                      </div>
                    </div>
                  </form>

                </div>
                <div class="card-footer">
                  <p class="text-muted">Cuidado con ingresar datos erroneos</p>
                </div>
              </div>
            </div>
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
<script src="../js/usuario.js"></script>