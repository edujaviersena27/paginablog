<?php
include_once '../modelo/Categoria.php';
$categoria = new categoria();

if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre_categoria'];
   $nombreCategoria=strtoupper($nombre);
    echo $categoria->crear($nombreCategoria);
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