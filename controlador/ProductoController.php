<?php
include '../modelo/producto.php';
$producto= new producto();

if ($_POST['funcion']=='crear') {
    $nombre=$_POST['nombre'];
    $concentracion=$_POST['concentracion'];
    $adicional=$_POST['adicional'];
    $precio=$_POST['precio'];
    $laboratorio=$_POST['laboratorio'];
    $tipo=$_POST['tipo'];
    $presentacion=$_POST['presentacion'];
    $avatar='prod_default.png';
    $producto->crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar);
}

if ($_POST['funcion']=='editar') {
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $concentracion=$_POST['concentracion'];
    $adicional=$_POST['adicional'];
    $precio=$_POST['precio'];
    $laboratorio=$_POST['laboratorio'];
    $tipo=$_POST['tipo'];
    $presentacion=$_POST['presentacion'];

    $producto->editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion);
}

if ($_POST['funcion']=='buscar') {
$producto->buscar();
$json= array();
    foreach($producto->objetos as $objeto){
        $producto->obtener_stock($objeto->id_producto);
        foreach ($producto->objetos as $obj) {
            $total=$obj->total;
        }
        $json[]=array(
            'id'=>$objeto->id_producto,
            'nombre'=>$objeto->nombre,
            'concentracion'=>$objeto->concentracion,
            'adicional'=>$objeto->adicional,
            'precio'=>$objeto->precio,
            'stock'=>$total,
            'laboratorio'=>$objeto->laboratorio,
            'tipo'=>$objeto->tipo,
            'presentacion'=>$objeto->presentacion,
            'laboratorio_id'=>$objeto->prod_lab,
            'tipo_id'=>$objeto->prod_tip_prod,
            'presentacion_id'=>$objeto->prod_present,
            'avatar'=>'../img/prod/'.$objeto->avatar,
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}

if ($_POST['funcion']=='cambiar_avatar') {
    $id=$_POST['id_logo_prod'];
    $avatar=$_POST['avatar'];
        if (($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')) {
            //Las imagenes se envia por FILES
            $nombre = uniqid() . '-' . $_FILES['foto']['name'];
            $ruta = '../img/prod/' . $nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
            $producto->cambiar_avatar($id, $nombre);
                if ($avatar!='../img/prod/prod_default.png') {
                    unlink($avatar);
                }                
            $json = array();
            $json[] = array(
                'ruta' => $ruta,
                'alert' => 'edit'
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        } else {
            $json = array();
            $json[] = array(
                'alert' => 'noedit'
            );
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }

    if ($_POST['funcion']=='borrar') {
        $id=$_POST['id'];
        $producto->borrar($id);      
    }

    if ($_POST['funcion']=='buscar_id') {
        $id=$_POST['id_producto'];
        $producto->buscar_idp($id);
        $json= array();
            foreach($producto->objetos as $objeto){
                $producto->obtener_stock($objeto->id_producto);
                foreach ($producto->objetos as $obj) {
                    $total=$obj->total;
                }
                $json[]=array(
                    'id'=>$objeto->id_lote,
                    'nombre'=>$objeto->nombre,
                    'vencimiento'=>$objeto->vencimiento,
                    'lote'=>$objeto->lote,
                    'concentracion'=>$objeto->concentracion,
                    'adicional'=>$objeto->adicional,
                    'precio'=>$objeto->precio,
                    'stock'=>$objeto->stock,
                    'laboratorio'=>$objeto->laboratorio,
                    'tipo'=>$objeto->tipo,
                    'presentacion'=>$objeto->presentacion,
                    'laboratorio_id'=>$objeto->prod_lab,
                    'tipo_id'=>$objeto->prod_tip_prod,
                    'presentacion_id'=>$objeto->prod_present,
                    'avatar'=>'../img/prod/'.$objeto->avatar,
                );
            }
            $jsonstring=json_encode($json[0]);
            echo $jsonstring;
        }

    if ($_POST['funcion']=='verificar_stock') {
            $error=0;
            $productos=json_decode($_POST['productos']);
            foreach ($productos as $objeto) {
                $producto->obtener_stock_lote($objeto->id);
                foreach ($producto->objetos as $obj) {
                    $total=$obj->total;
                }if ($total>=$objeto->cantidad && $objeto->cantidad>0) {
                    $error=$error+0;
                }else{
                    $error=$error+1;
                }
            }
            echo $error;
        }
?>