<?php
session_start();

if(isset($_SESSION['usr_role'])) {
	session_destroy();

			echo'<script type="text/javascript"> ;
			window.location.href="../vista/login.php";</script>';
// no funciona	header("Location: login.php");
} else {
	
		echo'<script type="text/javascript"> ;
		window.location.href="../vista/login.php";</script>';
// no funciona		header("Location: login.php");
}
?>