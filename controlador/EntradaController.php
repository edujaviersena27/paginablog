<?php
include '../modelo/Entrada.php';
$entrada = new entrada();

if ($_POST['funcion'] == 'crear') {
    $titulo = $_POST['titulo'];
    $adicional = $_POST['adicional'];
    $categoria = $_POST['categoria'];
    $link = $_POST['link'];
    $username = $_SESSION['usr_name'];
    echo $entrada->crear($titulo, $adicional, $categoria, $link, $username);
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

if ($_POST['funcion'] == 'buscar_codigo') {
    $json = array();
    $producto->buscar_codigo();

    foreach ($producto->objetos as $objeto) {
        $producto->obtener_stock($objeto->id_producto);
        foreach($producto->objetos as $obj){
            $total=$obj->total;
        }
        $json[] = array(
           
            'id' => $objeto->id_producto,
            'nombre' => $objeto->nombre,
            'concentracion' => $objeto->concentracion,
            'adicional' => $objeto->adicional,
            'precio' => $objeto->precio,
            'stock' => $total,
            'laboratorio' => $objeto->laboratorio,
            'tipo' => $objeto->tipo,
            'presentacion' => $objeto->presentacion,
            'laboratorio_id' => $objeto->prod_lab,
            'tipo_id' => $objeto->prod_tip_prod,
            'presentacion_id' => $objeto->prod_present,
            'avatar' => '../img/prod/' . $objeto->avatar,

        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion'] == 'cambiar_avatar') {
    $id = $_POST['id_logo_prod'];
    $avatar = $_POST['avatar'];
    if (($_FILES['photo']['type'] == 'image/jpeg') || ($_FILES['photo']['type'] == 'image/png') || ($_FILES['photo']['type'] == 'image/gif')) {
        $nombre = uniqid() . '-' . $_FILES['photo']['name'];
        $ruta = '../img/prod/'. $nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'], $ruta);
        $producto->cambiar_logo($id, $nombre);
        if ($avatar != '../img/prod/prod_defautlt.png') {
            unlink($avatar);
        }

        $json = array();
        $json[] = array(
            'ruta' => $ruta,
            'alert' => 'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    } 
    else {
        $json = array();
        $json[] = array(
            'alert' => 'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}


if($_POST['funcion']=='borrar') {
    $titulo=$_POST['titulo'];
    $entrada->borrar($titulo);
}

?>
