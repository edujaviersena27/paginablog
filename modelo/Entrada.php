<?php
session_start();
class entrada
{
    var $objetos;

    function crear($titulo, $adicional, $categoria, $link, $username)
    {
        $archivo = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            fputs($archivo, $titulo . "|" . $adicional . "|" . $categoria . "|" . $link . "|" . $username . "|" . "\n");

            return 'add';
        }
        fclose($archivo);
    }

    function editar($titulo, $adicional, $categoria, $link, $username, $edit_ent)
    {
        $delete = false;
        $myfile = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Entradas.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($edit_ent)) != 0) {
                fputs($bkfile, $linea);
            } else {
                fputs($bkfile, $titulo . "|" . $adicional . "|" . $categoria . "|" . $link . "|" . $username . "|" . "\n");
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Entradas.dat")) {
            rename("../Data/Entradas.bkp", "../Data/Entradas.dat");
        }

        ////					
        if ($delete) {
            echo 'edit';
        } else {
            echo 'noedit';
        }
    }




    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $json = array();

            $archivo = fopen('../Data/Entradas.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
            while (!feof($archivo)) {

                $linea = fgets($archivo);
                $datos = explode("|", $linea);



                if ($datos[0] != null && $datos[1] != null && $datos[2] != null && $datos[3] != null && $datos[4] != null) {

                    if (strcmp(trim($datos[0]), trim($consulta)) == 0) {

                        $json[] = array(

                            'titulo' => $datos[0],
                            'adicional' => $datos[1],
                            'categoria' => $datos[2],
                            'link' => $datos[3],
                            'username' => $datos[4],
                            'usuario' => $_SESSION['usr_name'],
                            'rol' =>  $_SESSION['usr_role']
                        );
                    }
                }
            }
            fclose($archivo);

            $jsonstring = json_encode($json);


            return $jsonstring;
        } else {
            $json = array();

            $archivo = fopen('../Data/Entradas.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
            while (!feof($archivo)) {

                $linea = fgets($archivo);
                $datos = explode("|", $linea);



                if ($datos[0] != null && $datos[1] != null && $datos[2] != null && $datos[3] != null && $datos[4] != null) {



                    $json[] = array(

                        'titulo' => $datos[0],
                        'adicional' => $datos[1],
                        'categoria' => $datos[2],
                        'link' => $datos[3],
                        'username' => $datos[4],
                        'usuario' => $_SESSION['usr_name'],
                        'rol' =>  $_SESSION['usr_role']
                    );
                }
            }
            fclose($archivo);

            $jsonstring = json_encode($json);


            return $jsonstring;
        }
    }




    function borrar($titulo)
    {


        $delete = false;
        $myfile = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Entradas.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($titulo)) != 0) {
                fputs($bkfile, $linea);
            } else {
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Entradas.dat")) {
            rename("../Data/Entradas.bkp", "../Data/Entradas.dat");
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
}
