<?php
session_start();

if (isset($_SESSION['usr_role']) != "") {
  echo '<script type="text/javascript"> ;
		window.location.href="index.php";</script>';
  // no funciona	en algunas ocaciones	header("Location: index.php");
}


//Comprobar de envío el formulario
if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  ///// busca el usuario /////


  $ok = 0;
  $archivo = fopen('../Data/Registro.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
  while (!feof($archivo) and $ok == 0) {
    ///	$lastname    |$mail	|$active|$role|$passwd
    /// Fabian Lopez|fabian.enrique.lopez@gmail.com|0|1|5f4dcc3b5aa765d61d8327deb882cf99 //
    $linea = fgets($archivo);
    $datos = explode("|", $linea);
    $lastname = $datos[0];
    $mail = $datos[1];
    $active = $datos[2];
    $role = $datos[3];
    $passwd = $datos[4];
    //		var_dump($linea);
    //		var_dump($email);
    //		var_dump($password); 
    //		var_dump(md5($password));
    //		exit;
    if ($email == $mail and md5(trim($password)) == trim($passwd)) {
      if ($active = 1) {
        $ok = 1;  // active = 1-->> significa que esta activo 
      } else {
        $ok = 2; //  active = 0-->> significa que no lo activo
      }
    }
  }

  ////////////////////////////
  //	echo 'valor $ok'.var_dump($ok);
  if ($ok == 0) {
    $errormsg = "Revisa los datos!!!";
  } elseif ($ok == 2) {
    $errormsg = "Usuario Inactivo!!!";
  } else {
    $_SESSION['usr_role'] = $role;
    $_SESSION['usr_name'] = $lastname;
    echo '<script type="text/javascript"> alert("Conexion exitosa");
			window.location.href="index.php";</script>';
    //		<script>window.location="http://localhost:8000/ExampleLoginPHP/index.php";</script>
  }
}

?>



<title>Blog Videojuegos</title>
<?php
include_once 'layouts/nav.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper center">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="animate__animated animate__shakeY">Iniciar Sesión</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">iniciar sesión</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <div class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
            <div class="input-group mb-3">
            <input type="email" name="email" placeholder="Ingresar Email" required class="form-control" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" name="password" placeholder="Ingresar Contraseña" required class="form-control" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="form-group">
                <input type="submit" name="login" value="Iniciar Sesion" class="btn btn-primary" />
                <input type="reset" value="Limpiar" class="btn btn-default">
              </div>
              
              <!-- /.col -->
            </div>
          </form>

          <div class="social-auth-links text-center mb-3">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-primary">
              <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
            </a>
            <a href="#" class="btn btn-block btn-danger">
              <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
            </a>
          </div>
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <a href="../vista/register.php" class="text-center">Register a new membership</a>
          </p>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
  </div>
</div>
<!-- /.content-wrapper -->

<?php
include_once 'layouts/footer.php';
?>