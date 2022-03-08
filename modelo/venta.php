<?php
include_once 'Conexion.php';
class venta{
    var $objetos;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($ruc,$razsocial,$total,$fecha,$vendedor){
        $sql = "INSERT INTO venta(fecha,ruc,razsocial,total,vendedor) values(:fecha,:ruc,:razsocial,:total,:vendedor)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':fecha' => $fecha,':ruc' => $ruc,':razsocial' => $razsocial,':total' => $total,':vendedor' => $vendedor));
    }

    function ultima_venta(){
            $sql = "SELECT MAX(id_venta) as ultima_venta FROM venta";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
    }
    function borrar($id_venta){
        $sql = "DELETE FROM venta where id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
        echo 'delete';
    }

    function buscar(){
        $sql = "SELECT id_venta,fecha,ruc,razsocial,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function verificar($id_venta,$id_usuario){
        $sql = "SELECT * FROM venta WHERE vendedor=:id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_usuario'=>$id_usuario,':id_venta'=>$id_venta));
        $this->objetos = $query->fetchall();
        if (!empty( $this->objetos)) {
            return 1;
        }else{
            return 0;
        }
    }

    function recuperar_vendedor($id_venta){
        $sql = "SELECT us_tipo FROM venta join usuario on id_usuario=vendedor where  id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function producto_mas_vendido(){
        $sql = "SELECT id_ventaproducto, SUM(cantidad) as cantidad, producto.nombre as nombre
        FROM venta_producto
        join lote on lote_id_lote=id_lote
        join producto on lote_id_prod=id_producto
        GROUP by id_producto
        ORDER BY SUM(venta_producto.cantidad) DESC LIMIT 1;";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_id($id_venta){
        $sql = "SELECT id_venta,fecha,ruc,razsocial,total, CONCAT(usuario.nombre_us,' ',usuario.apellidos_us) as vendedor FROM venta join usuario on vendedor=id_usuario and id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

}
    
?>