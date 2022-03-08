<?php
include '../modelo/venta.php';
$venta  = new venta();

if ($_POST['funcion']=='listar') {
    $venta->buscar();
    $json=array();
    foreach ($venta -> objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion']=='mostrar_consulta') {
    $venta->producto_mas_vendido();
    $json=array();
    foreach ($venta -> objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
?>
