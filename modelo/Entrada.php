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

    function editar($titulo, $adicional, $categoria, $link, $username)
    {
        echo 'edit';
        echo 'noedit';
    }

    function buscar()
    {

        $json = array();

        $archivo = fopen('../Data/Entradas.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
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
                    'usuario' => $_SESSION['usr_name']
                );
            }
        }
        fclose($archivo);

        $jsonstring = json_encode($json);


        return $jsonstring;
    }



    function borrar($titulo)
    {
        $archivo = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            $linea = fgets($archivo);
            $datos = explode("|", $linea);
            for($i=0;$i<5;$i++){
                if ($titulo == $datos[$i]) {
                    unlink($linea);
                   
                   
                    echo 'borrado';
                } 
            }
           
        }
        fclose($archivo);

    }

}
