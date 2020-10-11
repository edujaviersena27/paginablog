<?php
include_once '../modelo/Categoria.php';
$categoria = new categoria();

if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre_categoria'];
    echo $categoria->crear($nombre);
}



if ($_POST['funcion'] == 'buscar') {
    echo $categoria->buscar();
}

if($_POST['funcion']=='rellenar_presentaciones') {
    echo  $categoria->rellenar_presentaciones();
 
 }
