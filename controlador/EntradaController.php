<?php
include '../modelo/Entrada.php';
$entrada = new entrada();

if ($_POST['funcion'] == 'crear') {
    $titulo = $_POST['titulo'];
    $nombreTitulo= strtoupper($titulo);
    $adicional = $_POST['adicional'];
    $categoria = $_POST['categoria'];
    $link = $_POST['link'];
    $username = $_SESSION['usr_name'];
    echo $entrada->crear($nombreTitulo, $adicional, $categoria, $link, $username);
}


if ($_POST['funcion'] == 'editar') {
    $titulo = $_POST['titulo'];
    $adicional = $_POST['adicional'];
    $categoria = $_POST['categoria'];
    $link = $_POST['link'];
    $username = $_SESSION['usr_name'];
    echo $entrada->editar($titulo, $adicional, $categoria, $link, $username);
}

if ($_POST['funcion'] == 'buscar') { 
   
     echo $entrada->buscar();
  
}




if($_POST['funcion']=='borrar') {
    $titulo=$_POST['titulo'];
    $entrada->borrar($titulo);
}
