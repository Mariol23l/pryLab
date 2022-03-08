<?php
include '../modelo/cliente.php';

$cliente = new cliente();

if ($_POST['funcion'] == 'crear') {
    $ruc = $_POST['ruc'];
    $razsocial = $_POST['razsocial'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $avatar = 'cli_default.png';
    $cliente->crear($ruc, $razsocial, $contacto,$telefono, $correo, $direccion, $avatar);
}

if ($_POST['funcion'] == 'editar') {
    $id = $_POST['id'];
    $ruc = $_POST['ruc'];
    $razsocial = $_POST['razsocial'];
    $contacto = $_POST['contacto'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $cliente->editar($id,$ruc, $razsocial,$contacto, $telefono, $correo, $direccion);
}

if ($_POST['funcion'] == 'buscar') {
    $cliente->buscar();
    $json = array();
    foreach ($cliente->objetos as $objeto) {
        $json[] = array(
            'id' => $objeto->id_cliente,
            'ruc' => $objeto->ruc,
            'razsocial' => $objeto->razsocial,
            'contacto' => $objeto->contacto,
            'telefono' => $objeto->telefono,
            'correo' => $objeto->correo,
            'direccion' => $objeto->direccion,
            'avatar' => '../img/cli/' . $objeto->avatar,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}


if ($_POST['funcion']=='cambiar_logo') {
    $id=$_POST['id_edit_cli'];
    $avatar=$_POST['avatar'];
        if (($_FILES['foto']['type'] == 'image/jpeg') || ($_FILES['foto']['type'] == 'image/png') || ($_FILES['foto']['type'] == 'image/gif')) {
            //Las imagenes se envia por FILES
            $nombre = uniqid() . '-' . $_FILES['foto']['name'];
            $ruta = '../img/cli/' . $nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
            $cliente->cambiar_avatar($id, $nombre);
                if ($avatar!='../img/cli/cli_default.png' || $avatar==null) {
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
        $cliente->borrar($id);
    }

    if ($_POST['funcion'] == 'buscar_cliente') {
        $cliente->buscar_cliente();
        $json = array();
        foreach ($cliente->objetos as $objeto) {
            $json[] = array(
                'id' => $objeto->id_cliente,
                'ruc' => $objeto->ruc,
                'razsocial' => $objeto->razsocial,
                'direccion' => $objeto->direccion,
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
?>