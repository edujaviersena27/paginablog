<?php
session_start();
class categoria
{
    var $objetos;

 
    function crear($nombre)
    {
    
        $archivo = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            if($nombre!=null){
                fputs($archivo, $nombre ."|". "\n");
    
                return 'add';
            }
           
        }
    
        fclose($archivo);
    }

    function buscar () {
        $json = array();

        $archivo = fopen('../Data/Categorias.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {
    
            $linea = fgets($archivo);
            $datos = explode("|", $linea);
    
          if($datos[0]!=null){
            $json[] = array(
    
                'categoria' => $datos[0]
            );
          }
       
        }
         fclose($archivo);  
    
    
        $jsonstring = json_encode($json);
        return $jsonstring;
    }


    function borrar($id)
    {
      
    }

    function editar($nombre, $id_editado)
    {
      
    }

    function rellenar_presentaciones()
    {

        $json = array();

        $archivo = fopen('../Data/Categorias.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {
    
            $linea = fgets($archivo);
            $datos = explode("|", $linea);
    
          if($datos[0]!=null && $datos[0]!="\n")
                $json[] = array(
    
                    'categoria' => $datos[0]
                );
            
        }
        fclose($archivo);
    
    
        $jsonstring = json_encode($json);
        return $jsonstring;

    }
}
