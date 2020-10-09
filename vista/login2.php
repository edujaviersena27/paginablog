<?php
session_start();

if(isset($_SESSION['usr_role'])!="") {
		echo'<script type="text/javascript"> ;
		window.location.href="index.php";</script>';
// no funciona	en algunas ocaciones	header("Location: index.php");
}


//Comprobar de envío el formulario
if (isset($_POST['login'])) {

	$email = $_POST['email'];
	$password = $_POST['password'];

///// busca el usuario /////


	$ok=0;
	$archivo=fopen('./Data/Registro.dat','r+') or die ("Error de apertura de archivo, consulte con el administrador...");
	while(!feof($archivo) and $ok==0)
	{
///	$lastname    |$mail	|$active|$role|$passwd
/// Fabian Lopez|fabian.enrique.lopez@gmail.com|0|1|5f4dcc3b5aa765d61d8327deb882cf99 //
	    $linea=fgets($archivo);
		$datos=explode("|",$linea);
		$lastname= $datos[0];
		$mail= $datos[1];
		$active=$datos[2];
		$role=$datos[3];
		$passwd=$datos[4];
//		var_dump($linea);
//		var_dump($email);
//		var_dump($password); 
//		var_dump(md5($password));
//		exit;
	   	if($email==$mail and md5(trim($password))==trim($passwd))
	   	{
			if ($active=1){
				$ok=1;	// active = 1-->> significa que esta activo 
			}
			else{
				$ok=2; //  active = 0-->> significa que no lo activo
			}
	  	}
	}

////////////////////////////
//	echo 'valor $ok'.var_dump($ok);
	if ($ok==0)
	{
		$errormsg = "Revisa los datos!!!";	
	}
	elseif ($ok==2)
	{
		$errormsg = "Usuario Inactivo!!!";		
	}
	else
	{
		$_SESSION['usr_role'] = $role;
		$_SESSION['usr_name'] = $lastname;
		echo'<script type="text/javascript"> alert("Conexion exitosa");
			window.location.href="index.php";</script>';
//		<script>window.location="http://localhost:8000/ExampleLoginPHP/index.php";</script>
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de session</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php" style="font-family: 'Lobster', cursive;">DevEdiII</a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li class="active"><a href="login.php">Login</a></li>
				<li><a href="register.php">Registro</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					<!--div class="form-group clearfix">
						<img src="http://www.iconsfind.com/wp-content/uploads/2016/10/20161014_58006bff8b1de.png" alt="" width="200px" class="img-responsive img-circle" style="margin:0 auto">
					</div-->

					<div class="form-group">
						<label for="name">E-mail</label>
						<input type="text" name="email" placeholder="Ingresar Email" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">Contraseña</label>
						<input type="password" name="password" placeholder="Ingresar Contraseña" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Iniciar Sesion" class="btn btn-primary" />
						<input type="reset" value="Limpiar" class="btn btn-default" >
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		No tienes cuenta? <a href="register.php">Regitrate aqui</a>
		</div>
	</div>
</div>

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
