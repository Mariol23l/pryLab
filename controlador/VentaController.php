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

if ($_POST['funcion']=='buscar_venta') {
    $venta->buscar_venta();
    $json= array();
    $fecha_actual=new DateTime();
    foreach($venta->objetos as $objeto){
        $vencimiento =new DateTime($objeto->fechaven);
        $diferencia=$vencimiento->diff($fecha_actual);
        $anio=$diferencia->y;
        $mes=$diferencia->m;
        $dia=$diferencia->d;
        $verficado=$diferencia->invert;
        if ($verficado==0) {
            $mes=$mes*(-1);
            $dia=$dia*(-1);
            $estado='danger';
        }else {  
            if($mes>3 || $anio>=1){
                $estado='light';
            }
            else if($mes<=3 ){
                $estado='warning';
            }
        }
        $json[]=array(
            'id'=>$objeto->id_venta,
            'ruc'=>$objeto->ruc,
            'razsocial'=>$objeto->razsocial,
            'formapago'=>$objeto->formapago,
            'total'=>$objeto->total,
            'fechaemision'=>$objeto->fecha,
            'fechavencimiento'=>$objeto->fechaven,
            'vendedor'=>$objeto->nombre_us,
            'estado'=>$estado
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion']=='borrar') {
    $id=$_POST['id'];
    $lote->borrar($id);
    
}
?>
