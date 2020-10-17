<?php
session_start();
class categoria
{
    var $objetos;


    function crear($nombre, $username)
    {

        $archivo = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            if ($nombre != null) {
                fputs($archivo, $nombre . "|" . $username . "|" . "\n");

                return 'add';
            }
        }

        fclose($archivo);
    }

    function buscar()
    {
        $json = array();

        $archivo = fopen('../Data/Categorias.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {

            $linea = fgets($archivo);
            $datos = explode("|", $linea);

            if ($datos[0] != null && $datos[1] != null) {
                $json[] = array(

                    'categoria' => $datos[0],
                    'username' => $datos[1],
                    'usuario' =>  $_SESSION['usr_name'],
                    'rol' =>  $_SESSION['usr_role']
                );
            }
        }
        fclose($archivo);


        $jsonstring = json_encode($json);
        return $jsonstring;
    }


    function borrar($nombreCat)
    {


        $delete = false;
        $myfile = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Categorias.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($nombreCat)) != 0) {
                fputs($bkfile, $linea);
            } else {
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Categorias.dat")) {
            rename("../Data/Categorias.bkp", "../Data/Categorias.dat");
        } else {
            echo 'noborrado';
        }

        ////					
        if ($delete) {
            echo 'borrado';
        } else {
            echo 'noborrado';
        }
    }

    function editar($nombreCategoria, $username, $edit_cat)
    {
        $delete = false;
        $myfile = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Categorias.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($edit_cat)) != 0) {
                fputs($bkfile, $linea);
            } else {
                fputs($bkfile, $nombreCategoria . "|" . $username . "|" . "\n");
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Categorias.dat")) {
            rename("../Data/Categorias.bkp", "../Data/Categorias.dat");
        }

        ////					
        if ($delete) {
            echo 'edit';
        } else {
            echo 'noedit';
        }
    }

    function rellenar_presentaciones()
    {

        $json = array();

        $archivo = fopen('../Data/Categorias.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {

            $linea = fgets($archivo);
            $datos = explode("|", $linea);

            if ($datos[0] != null && $datos[0] != "\n")
                $json[] = array(

                    'categoria' => $datos[0]
                );
        }
        fclose($archivo);


        $jsonstring = json_encode($json);
        return $jsonstring;
    }
}
