<?php
include '../modelo/lote.php';
$lote = new lote();

if ($_POST['funcion']=='crear') {
    $id_producto = $_POST['id_producto'];
    $proveedor = $_POST['proveedor'];
    $stock = $_POST['stock'];
    $vencimiento = $_POST['vencimiento'];
    $codlote=$_POST['codlote'];
    $lote->crear($id_producto, $proveedor, $stock, $vencimiento,$codlote);
}

if ($_POST['funcion']=='editar') {
    $id_lote = $_POST['id'];
    $stock = $_POST['stocklote'];
    $vencimiento = $_POST['venlote'];
    $codlote=$_POST['codigolote'];
    $lote->editar($id_lote, $stock, $vencimiento,$codlote);
}

if ($_POST['funcion']=='buscar') {
    $lote->buscar();
    $json= array();
    $fecha_actual=new DateTime();
    foreach($lote->objetos as $objeto){
        $vencimiento =new DateTime($objeto->vencimiento);
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
            'id'=>$objeto->id_lote,
            'idp'=>$objeto->lote_id_prod,
            'stock'=>$objeto->stock,
            'lote'=>$objeto->lote,
            'vencimiento'=>$objeto->vencimiento,
            'concentracion'=>$objeto->concentracion,
            'adicional'=>$objeto->adicional,
            'nombre'=>$objeto->prod_nombre,
            'laboratorio'=>$objeto->lab_nombre,
            'proveedor'=>$objeto->proveedor,       
            'tipo'=>$objeto->tip_nom,
            'presentacion'=>$objeto->pre_nom,
            'avatar'=>'../img/prod/'.$objeto->logo,
            'precio'=>$objeto->precio,
            'mes'=>$mes,
            'dia'=>$dia,
            'estado'=>$estado,
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