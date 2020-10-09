<?php
session_start();

if(isset($_SESSION['usr_role'])) {
	session_destroy();
	unset($_SESSION['usr_role']);
	unset($_SESSION['usr_name']);
			echo'<script type="text/javascript"> ;
			window.location.href="login.php";</script>';
// no funciona	header("Location: login.php");
} else {

		echo'<script type="text/javascript"> ;
		window.location.href="login.php";</script>';
// no funciona		header("Location: login.php");
}
?>