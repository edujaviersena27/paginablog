<?php

class Usuario
{
    var $objetos;

    function buscar()
    {
        $json = array();

        $archivo = fopen('../Data/Registro.dat', 'r+') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {

            $linea = fgets($archivo);
            $datos = explode("|", $linea);



            if ($datos[0] != null && $datos[1] != null && $datos[2] != null && $datos[3] != null && $datos[4] != null) {



                $json[] = array(

                    'nombre' => $datos[0],
                    'email' => $datos[1],
                    'activar' => $datos[2],
                    'rol' => $datos[3],
                    'pass' => $datos[4],
                    
                );
            }
        }
        fclose($archivo);

        $jsonstring = json_encode($json);


        return $jsonstring;
    }

    function crear($nombre,$email,$activar,$rol,$pass)
    {
        $archivo = fopen('../Data/Registro.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            fputs($archivo, $nombre . "|" . $email . "|" . $activar . "|" . $rol . "|" . md5($pass) . "\n");

            return 'add';
        }
        fclose($archivo);
    }

  

    function editar($nombre,$email,$activar,$rol,$pass, $edit_user){
        $delete = false;
        $myfile = fopen('../Data/Registro.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Registro.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($edit_user)) != 0) {
                fputs($bkfile, $linea);
            } else {
                fputs($bkfile, $nombre . "|" . $email . "|" . $activar . "|" . $rol . "|" . $pass . "\n");
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Registro.dat")) {
            rename("../Data/Registro.bkp", "../Data/Registro.dat");
        }

        ////					
        if ($delete) {
            echo 'edit';
        } else {
            echo 'noedit';
        }
    }

    function borrar($id)
    {


        $delete = false;
        $myfile = fopen('../Data/Registro.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        $bkfile = fopen("../Data/Registro.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
        while (!feof($myfile)) {
            $linea = fgets($myfile);
            $datos = explode("|", $linea);

            if (strcmp(trim($datos[0]), trim($id)) != 0) {
                fputs($bkfile, $linea);
            } else {
                $delete = true;
            }
        }
        fclose($myfile);
        fclose($bkfile);
        if (unlink("../Data/Registro.dat")) {
            rename("../Data/Registro.bkp", "../Data/Registro.dat");
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
