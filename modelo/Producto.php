<?php
class producto
{
    var $objetos;
 
    function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar) {
        $sql = "SELECT id_producto FROM producto where nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos = $query->fetchall();
        if(!empty($this->objetos)) {
            echo 'noadd';
        }
        else{
            $sql = "INSERT INTO producto(nombre,concentracion,adicional,precio,prod_lab,prod_tip_prod,prod_present,avatar) values (:nombre,:concentracion,:adicional,:precio,:laboratorio,:tipo,:presentacion,:avatar);";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':avatar'=>$avatar));
            echo 'add';
        }

    }

    function editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion) {
        $sql = "SELECT id_producto FROM producto where id_producto!=:id and nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
        $this->objetos = $query->fetchall();
        if(!empty($this->objetos)) {
            echo 'noedit';
        }
        else{
            $sql = "UPDATE producto SET nombre=:nombre, concentracion=:concentracion, adicional=:adicional, prod_lab=:laboratorio, prod_tip_prod=:tipo, prod_present=:presentacion, precio=:precio where id_producto=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':precio'=>$precio,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
            echo 'edit';
        }

    }

    function buscar(){
        if(!empty($_POST['consulta'])) {
            $consulta=$_POST['consulta'];
            $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
            presentacion.nombre as presentacion, producto.avatar as avatar, prod_lab, prod_tip_prod, prod_present
            FROM producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion and producto.nombre LIKE :consulta limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
            
        }else {
            $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
            presentacion.nombre as presentacion, producto.avatar as avatar , prod_lab, prod_tip_prod, prod_present
            FROM producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion and producto.nombre NOT LIKE '' order by producto.nombre  limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }   
    }

    function buscar_codigo(){
        if(!empty($_POST['consulta'])) {
            $consulta=$_POST['consulta'];
            $sql = "SELECT id_producto, producto.adicional as adicional, producto.nombre as nombre, concentracion, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
            presentacion.nombre as presentacion, producto.avatar as avatar, prod_lab, prod_tip_prod, prod_present
            FROM producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion and producto.adicional LIKE :consulta limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
            
        }else {
            $sql = "SELECT id_producto, producto.adicional as adicional, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
            presentacion.nombre as presentacion, producto.avatar as avatar , prod_lab, prod_tip_prod, prod_present
            FROM producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion and producto.adicional NOT LIKE '' order by producto.nombre limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }   
    }


 

    function cambiar_logo($id,$nombre){
        $sql = "UPDATE producto SET avatar=:nombre where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' =>$id, ':nombre' =>$nombre));
    }

    function borrar($id) {
        $sql = "DELETE FROM producto where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' =>$id));
        if(!empty($query->execute(array(':id' =>$id)))){
           echo 'borrado'; 
        }
        else{
            echo 'noborrado';
        }
    }

    function obtener_stock($id){
        $sql="SELECT SUM(stock) as total FROM lote where lote_id_prod=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' =>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id) {
        $sql = "SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo,
        presentacion.nombre as presentacion, producto.avatar as avatar , prod_lab, prod_tip_prod, prod_present
        FROM producto
        join laboratorio on prod_lab=id_laboratorio
        join tipo_producto on prod_tip_prod=id_tip_prod
        join presentacion on prod_present=id_presentacion where id_producto=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

}
?>
