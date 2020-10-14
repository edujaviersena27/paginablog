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


    function borrar($nombreCat)
    {


            $delete = false;
            $myfile = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
            $bkfile = fopen("../Data/Categorias.bkp", "w+") or die("No se puede abrir el archivo de trabajo!");
            while(!feof($myfile)) {
                $linea = fgets($myfile);
                $datos=explode("|", $linea);
                
                if (strcmp(trim($datos[0]),trim($nombreCat))!=0 )
                {
                    fputs($bkfile,$linea);
                }
                else{
                    $delete = true;
                }
            }
            fclose($myfile);
            fclose($bkfile);
            if (unlink ("../Data/Categorias.dat")){
                rename ("../Data/Categorias.bkp","../Data/Categorias.dat");	
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
