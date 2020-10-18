<?php
include_once '../modelo/Usuario.php';

$usuario = new Usuario();

if($_POST['funcion']=='buscar_usuario') {

    echo $usuario->obtener_datos($_POST['dato']);
}

if($_POST['funcion']=='capturar_datos') {
    $json=array();
    $id_usuario=  $_POST['id_usuario'];
    $usuario->obtener_datos($id_usuario);
    foreach($usuario->objetos as $objeto) {
        $json[]= array(
            'telefono'=>$objeto->telefono_us,
            'residencia'=>$objeto->residencia_us,
            'correo'=>$objeto->correo_us,
            'sexo'=>$objeto->sexo_us,
            'adicional'=>$objeto->adicional_us

        );
    }
    $jsonstring= json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='editar_usuario') {
    $id_usuario=$_POST['id_usuario'];
    $telefono=$_POST['telefono'];
    $residencia=$_POST['residencia'];
    $correo=$_POST['correo'];
    $sexo=$_POST['sexo'];
    $adicional=$_POST['adicional'];
    $usuario->editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);

    echo 'editado';
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