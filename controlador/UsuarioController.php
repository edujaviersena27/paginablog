<?php
include_once '../modelo/Usuario.php';

$usuario = new Usuario();

if($_POST['funcion']=='buscar_usuario') {

    echo $usuario->obtener_datos($_POST['dato']);
}

if($_POST['funcion']=='capturar_datos') {
 echo $usuario->obtener_datos($_POST['id_usuario']);
}

if($_POST['funcion']=='editar_usuario') {
    $id_usuario=$_POST['id_usuario'];
  
    $nombre=$_POST['nombre'];
    $correo=$_POST['correo'];

    echo $usuario->editar_datos($id_usuario,$nombre,$correo);

    
}

if($_POST['funcion']=='cambiar_contra') {
    $id_usuario=$_POST['id_usuario'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
  
   echo $usuario->cambiar_contra($id_usuario,$oldpass,$newpass);


}



if($_POST['funcion']=='buscar_usuarios_adm') {
   echo $usuario->buscar();
}


if($_POST['funcion']=='crear_usuario') {
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $activar=$_POST['activar'];
    $rol=$_POST['rol'];
    $pass=$_POST['pass'];
    echo $usuario->crear($nombre,$email,$activar,$rol,$pass);
    
}

if($_POST['funcion']=='editar') {
    $nombre=$_POST['nombre'];
    $email=$_POST['email'];
    $activar=$_POST['activar'];
    $rol=$_POST['rol'];
    $pass=$_POST['pass'];
    $edit_user= $_POST['edit_user'];
    echo $usuario->editar($nombre,$email,$activar,$rol,$pass, $edit_user);
    
}


if($_POST['funcion']=='descender') {
    $pass=$_POST['pass'];
    $id_descendido=$_POST['id_usuario'];
    $usuario->descender($pass,$id_descendido,$id_usuario);
}

if($_POST['funcion']=='borrar') {
    $id=$_POST['id'];
    $usuario->borrar($id);
}
?>