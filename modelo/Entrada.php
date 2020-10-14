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

         
/// aqui va la logica de eliminar
// recorre el archivo , guarda en $linea la linea del mismo
// y luego compara lo que se encuentran en la posición 2, que es el DNI con el $_GET que contiene
// el Documento pasado por parametros --> sugerencia se podría pasar encriptado para mejorar
// si no es el que buscamos graba en el archivo nuevo, cuando es igual lo saltea y coloca en true
// la bandera para de borrado para indicar q lo ha encontrado
// cierra los archivos de trabajo y temporal, con unlink borra el anterior y con rename
// renombra con el que trabajamos y lo deja como nuevo archivo de datos real, siempre que pueda realizarlo
// tanto unlink como rename devuelve true si pudo realizar la acción

            $delete = false;
            $myfile = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
            $bkfile = fopen("../Data/Entradas.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
            while(!feof($myfile)) {
                $linea = fgets($myfile);
                $datos=explode("|", $linea);
                
                if (strcmp(trim($datos[0]),trim($titulo))!=0 )
                {
                    fputs($bkfile,$linea);
                }
                else{
                    $delete = true;
                }
            }
            fclose($myfile);
            fclose($bkfile);
            if (unlink ("../Data/Entradas.dat")){
                rename ("../Data/Entradas.bkp","../Data/Entradas.dat");	
            }
            else{
                echo 'noborrado';		
            }
        
////					
            if($delete){
                    echo 'borrado';
            }else{
                    echo 'noborrado';
            }				


    }

}
