<?php
session_start();
class categoria
{
    var $objetos;

 
    function crear($nombre)
    {
    
        $archivo = fopen('../Data/Categorias.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
    
            fputs($archivo, $nombre . "\n");
    
            return 'add';
        }
    
        fclose($archivo);
    }

    function buscar () {
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
        return $jsonstring;
    }


    function borrar($id)
    {
        $sql = "DELETE FROM presentacion where id_presentacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        } else {
            echo 'noborrado';
        }
    }

    function editar($nombre, $id_editado)
    {
        $sql = "UPDATE presentacion SET nombre=:nombre where id_presentacion=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id_editado, ':nombre' => $nombre));
        echo 'edit';
    }

    function rellenar_presentaciones()
    {
        $sql = "SELECT * FROM presentacion order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}