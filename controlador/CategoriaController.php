<?php
include_once '../modelo/Presentacion.php';
$presentacion = new presentacion();

if ($_POST['funcion'] == 'crear') {
    $nombre = $_POST['nombre_categoria'];
    echo crear($nombre);
}

function crear($nombre)
{

    $archivo = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
    while (!feof($archivo)) {

        fputs($archivo, $nombre . "\n");

        return 'add';
    }

    fclose($archivo);
}

if ($_POST['funcion'] == 'buscar') {
    $json = array();

    $archivo = fopen('../Data/Categorias.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
    while (!feof($archivo)) {

        $linea = fgets($archivo);
        $datos = explode("|", $linea);

        foreach ($datos as $dato) {
            $json[] = array(

                'categoria' => $dato
            );
        }
    }
    fclose($archivo);


    $jsonstring = json_encode($json);
    echo $jsonstring;
}
