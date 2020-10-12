<?php
class entrada
{
    var $objetos;

    function crear($titulo, $adicional, $categoria, $link)
    {
        $archivo = fopen('../Data/Entradas.dat', 'a+') or die("Error en registro, consulte con el administrador...");
        while (!feof($archivo)) {
            fputs($archivo, $titulo . "|" . $adicional . "|" . $categoria . "|" . $link . "|" . "\n");

            return 'add';
        }
        fclose($archivo);
    }

    function editar($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion)
    {
        $sql = "SELECT id_producto FROM producto where id_producto!=:id and nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql = "UPDATE producto SET nombre=:nombre, concentracion=:concentracion, adicional=:adicional, prod_lab=:laboratorio, prod_tip_prod=:tipo, prod_present=:presentacion, precio=:precio where id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id, ':nombre' => $nombre, ':concentracion' => $concentracion, ':adicional' => $adicional, ':precio' => $precio, ':laboratorio' => $laboratorio, ':tipo' => $tipo, ':presentacion' => $presentacion));
            echo 'edit';
        }
    }

    function buscar()
    {
        $json = array();

        $archivo = fopen('../Data/Entradas.dat', 'r') or die("Error de apertura de archivo, consulte con el administrador...");
        while (!feof($archivo)) {

            $linea = fgets($archivo);
            $datos = explode("|", $linea);

            if ($datos[0] != null && $datos[1] != null && $datos[2] != null && $datos[3] != null) {
                $json[] = array(

                    'titulo' => $datos[0],
                    'adicional' => $datos[1],
                    'categoria' => $datos[2],
                    'link' => $datos[3]
                );
            }
        }
        fclose($archivo);

        $jsonstring = json_encode($json);
        return $jsonstring;
    }

 

    function borrar($id)
    {
        $sql = "DELETE FROM producto where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        } else {
            echo 'noborrado';
        }
    }
}
