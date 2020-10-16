<?php
include_once '../modelo/Categoria.php';
$categoria = new categoria();

if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre_categoria'];
   $nombreCategoria=strtoupper($nombre);
   $username = $_SESSION['usr_name'];
    echo $categoria->crear($nombreCategoria, $username);
}



if ($_POST['funcion'] == 'buscar') {
   
    echo $categoria->buscar();
}

if($_POST['funcion']=='rellenar_presentaciones') {
    echo  $categoria->rellenar_presentaciones();
 
 }

 if($_POST['funcion']=='borrar') {
    $nombreCat=$_POST['nombre'];
    echo  $categoria->borrar($nombreCat);
 
 }