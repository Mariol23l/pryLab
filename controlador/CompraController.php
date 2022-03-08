<?php
include '../modelo/venta.php';
include_once '../modelo/Conexion.php';
$venta = new venta();
session_start();
$vendedor= $_SESSION['usuario'] ;

if ($_POST['funcion']=='registrar_compra') {
    $total=$_POST['total'];
    $ruc=$_POST['ruc'];
    $razsocial=$_POST['razsocial'];
    $productos=json_decode($_POST['json']);
    date_default_timezone_set('America/Lima');
    $fecha=date('Y-m-d H:i:s');
    $venta->crear($ruc,$razsocial,$total,$fecha,$vendedor);
    $venta->ultima_venta();
    foreach ($venta -> objetos as $objeto) {
        $id_venta=$objeto->ultima_venta;
        echo $id_venta;
    }
    try {
        $db=new Conexion();
        $conexion=$db->pdo;
        $conexion->beginTransaction();
        foreach ($productos as $prod) {
            $cantidad  =$prod->cantidad;
            while ($cantidad!=0) {
                $sql = "SELECT * FROM lote where id_lote=:id";
                $query = $conexion->prepare($sql);
                $query->execute(array(':id'=>$prod->id));
                $lote = $query->fetchall();
                    foreach ($lote as $lote) {
                        if ($cantidad<$lote->stock || $cantidad==$lote->stock || $cantidad<$lote->stock) {      
                            $sql="INSERT INTO detalle_venta (det_cantidad, det_vencimiento,id__det_lote,id__det_prod,lote_id_prov,id_det_venta) values ('$cantidad','$lote->vencimiento','$lote->id_lote','$prod->id','$lote->lote_id_prov','$id_venta')";                   
                            $conexion->exec($sql);
                            $conexion->exec("UPDATE lote SET stock= stock-'$cantidad' where id_lote='$lote->id_lote'");
                            $cantidad=0;
                        }
                    }
            }
            $subtotal=$prod->cantidad*$prod->precio;
            $conexion->exec("INSERT INTO venta_producto(precio_venta,cantidad,subtotal,lote_id_lote,venta_id_venta) values('$prod->precio','$prod->cantidad', '$subtotal','$prod->id','$id_venta')");
        }
        $conexion->commit();
    } catch (Exception $error) {
        //Rollback Anula todo lo que esta en el Try
        $conexion->rollBack();
        $venta->borrar($id_venta);
        echo $error->getMessage();
    }
}
?>