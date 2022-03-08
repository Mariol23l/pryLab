<?php
include_once '../modelo/VentaProducto.php';
$venta_Producto  = new ventaProducto();

if ($_POST['funcion']=='detalle_venta') {
    $id=$_POST['id'];
    $venta_Producto->buscar_detVenta($id);
    $json=array();
    foreach ($venta_Producto -> objetos as $objeto) {
        $json[]=$objeto;
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
