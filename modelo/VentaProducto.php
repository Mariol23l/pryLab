<?php
include_once 'Conexion.php';
class ventaProducto{
    var $objetos;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }

    function buscar_detVenta($id_venta){
        $sql = "SELECT venta_producto.precio_venta as preventa, cantidad,producto.nombre as nombre ,lote.lote as LOTE, concentracion, laboratorio.nombre as laboratorio, presentacion.nombre as presentacion, subtotal,vencimiento
        FROM venta_producto
        join lote on lote_id_lote=id_lote and venta_id_venta=:id
        join producto on lote_id_prod=id_producto
        join laboratorio on prod_lab=id_laboratorio
        join presentacion on prod_present=id_presentacion";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_venta));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function borrar($id_venta){
        $sql = "DELETE FROM venta_producto where venta_id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta' => $id_venta));
    }
}
    
?>