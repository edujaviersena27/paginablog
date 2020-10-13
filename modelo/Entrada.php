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
    }

    function editar2($id, $nombre, $concentracion, $adicional, $precio, $laboratorio, $tipo, $presentacion)
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

    function obtener_stock($id)
    {
        $sql = "SELECT SUM(stock) as total FROM lote where lote_id_prod=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id)
    {
        $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
        presentacion.nombre as presentacion, producto.avatar as avatar , prod_lab, prod_tip_prod, prod_present
        FROM producto
        join laboratorio on prod_lab=id_laboratorio
        join tipo_producto on prod_tip_prod=id_tip_prod
        join presentacion on prod_present=id_presentacion where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
