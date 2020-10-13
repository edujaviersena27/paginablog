<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['usr_id'])) {
  echo '<script type="text/javascript"> ;
		window.location.href="../vista/login.php";</script>';
}

// llamo a la función que se va a encargar de realizar el envio del mail ///

require("../funciones/funciones.php");

//Establece el error de validación como flag
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $terminosycond = $_POST['terminosycond'];

  //Nombre sólo puede contener caracteres alfabéticos y espacio (esto varia sgun requerimiento)
  if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $error = true;
    $name_error = "El nombre debe contener solo caracteres del alfabeto y espacio.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $email_error = "Ingresa un correo electrónico válido.";
  }
  if (strlen($password) < 6) {
    $error = true;
    $password_error = "La contraseña debe tener un mínimo de 6 caracteres.";
  }
  if ($password != $cpassword) {
    $error = true;
    $cpassword_error = "Las contraseñas no coinciden";
  }
  if (!$terminosycond) {
    //$error = true;
    //$terminosycond_error = "Debes aceptar Terminos y condiciones";
  }
  if (!$error) {

    //////////// codigo para verificar los datos ingresados

    $ok = 0;
    $archivo = fopen('../Data/Registro.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
    while (!feof($archivo) and $ok == 0) {
      $linea = fgets($archivo);
      $datos = explode("|", $linea);
      if($datos[0]!=null && $datos[1]!=null && $datos[2]!=null && $datos[3]!=null && $datos[4]!=null) {
        $lastname = $datos[0];
        $mail = $datos[1];
        $active = $datos[2];
        $role = $datos[3];
        $passwd = $datos[4];
      }
   


      if ($email == $mail) {
        $ok = 1;
      }
    }
    // si es igual usuario e identica pass y ademas esta activa podría ingresar
    fclose($archivo);

    if ($ok == 1) {
      //		echo " Debe verificar sus datos Ingreso un usuario ya registrado";

      //$errormsg = "Error de registro. Vuelve a intentarlo más tarde.";
      $errormsg = '
		<div class="alert alert-danger text-center">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Error de registro.!</strong> Verifica tus datos, ya existe un usuario registrado con el mismo Email.
		</div>
		';

      //si activada, que es el campo que seleccionamos es 0, informamos que debe activar su cuenta para poder usarla
    } else {
      $activ = 0;

      //		$ape=$_POST['ape'];
      //		$nom=$_POST['nom'];
      //		$email=$_POST['email'];
      $rol = 1;

      $archivo = fopen('../Data/Registro.dat', 'a+') or die("Error en registro, consulte con el administrador...");
      fputs($archivo, $name . "|" . $email . "|" . $activ . "|" . $rol . "|" . md5($password) . "\n");
      fclose($archivo);
      //			Se toman los datos del registro y se envia un mail con un link para poder activar el usuario
      //			que la actividad pendiente para realizar por los alumnos.
      enviar_mail($email, $name);
      //
      $successmsg = '
			  <div class="alert alert-success text-center">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>EXITO.!</strong> ¡Registrado exitosamente!
			  </div>
			  ';
    }
    ////////////

  }
}
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
          <h1 class="animate__animated animate__shakeY">Registro</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">registro</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">Register a new membership</p>

          <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
            <fieldset>
              <div class="input-group mb-3">
                <input type="text" name="name" placeholder="Nombres Completos" required value="<?php if ($error) echo $name; ?>" class="form-control" />
                <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" name="email" placeholder="Correo Electrónico" required value="<?php if ($error) echo $email; ?>" class="form-control" />
                <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="password" placeholder="Contraseña" required class="form-control" />
                <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" name="cpassword" placeholder="Confirmar Contraseña" required class="form-control" />
                <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="terminosycond" id="terminosycond" required=""> Acepto todos los
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#TernimosCondiciones">
                      Terminos y condiciones
                    </button>
                    <br>
                    <span class="text-danger"><?php if (isset($terminosycond_error)) echo $terminosycond_error; ?></span>
                  </label>
                </div>

                <div class="form-group">
                  <input type="submit" name="signup" value="Registrar" class="btn btn-primary" />
                </div>
              </div>
            </fieldset>
          </form>
          <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
		    	<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
     

          <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i>
              Sign up using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i>
              Sign up using Google+
            </a>
          </div>

          <a href="login.html" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

  </div>


</div>
<!-- /.content-wrapper -->

<?php
include_once 'layouts/footer.php';
?>