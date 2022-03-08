<?php
include_once '../modelo/VentaProducto.php';
include_once '../modelo/DetalleVenta.php';
include_once '../modelo/venta.php';
include_once '../modelo/lote.php';

$lote =new lote();
$venta= new venta();
$detalle_venta= new DetalleVenta();
$venta_Producto  = new ventaProducto();

session_start();
$id_usuario=$_SESSION['usuario'] ;
$tipo_usuario=$_SESSION['us_tipo']  ;

if ($_POST['funcion']=='borrar_venta') {
    $id_venta=$_POST['id'];
    if ($venta->verificar($id_venta,$id_usuario)==1) {
        $venta_Producto->borrar($id_venta);
        $detalle_venta->recuperar($id_venta);
        foreach ($detalle_venta->objetos as $det) {
            $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
            $detalle_venta->borrar($det->id_detalle);
        }
        $venta->borrar($id_venta);
    }
    else{
        if ($tipo_usuario==3) {
            $venta_Producto->borrar($id_venta);
            $detalle_venta->recuperar($id_venta);
            foreach ($detalle_venta->objetos as $det) {
                $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
                $detalle_venta->borrar($det->id_detalle);
        }
        $venta->borrar($id_venta);
        }
        else if ($tipo_usuario==1) {
            $venta->recuperar_vendedor($id_venta);
            foreach ($venta->objetos as $objeto) {
                if ($objeto->us_tipo==2) {
                    $venta_Producto->borrar($id_venta);
                    $detalle_venta->recuperar($id_venta);
                    foreach ($detalle_venta->objetos as $det) {
                        $lote->devolver($det->id__det_lote,$det->det_cantidad,$det->det_vencimiento,$det->id__det_prod,$det->lote_id_prov);
                        $detalle_venta->borrar($det->id_detalle);
                }
                 $venta->borrar($id_venta);
                }else{
                    echo 'nodelete';
                }
            }
        }
        else{
            echo 'delete';
        }
    }
}

?>
