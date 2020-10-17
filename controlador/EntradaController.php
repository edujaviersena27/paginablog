<?php
include '../modelo/Entrada.php';
$entrada = new entrada();
$tipo_usuario= $_SESSION['usr_role'];
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
    $nombreTitulo= strtoupper($titulo);
    $adicional = $_POST['adicional'];
    $categoria = $_POST['categoria'];
    $link = $_POST['link'];
    $edit_ent = $_POST['edit_ent'];
    $username = $_SESSION['usr_name'];
    echo $entrada->editar($nombreTitulo, $adicional, $categoria, $link, $username, $edit_ent);
}

if ($_POST['funcion'] == 'buscar') { 
   
     echo $entrada->buscar();
  
}

if ($_POST['funcion'] == 'buscar_entrada') { 
   
    echo $entrada->buscar();
 
}




if($_POST['funcion']=='borrar') {
    $titulo=$_POST['titulo'];
    $entrada->borrar($titulo);
}

if($_POST['funcion']=='tipo_usuario') {
    echo $tipo_usuario;
}
