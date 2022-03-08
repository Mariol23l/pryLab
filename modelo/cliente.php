<?php
include 'Conexion.php';
class cliente{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($ruc,$razsocial,$contacto,$telefono,$correo,$direccion,$avatar){
        $sql = "SELECT id_cliente FROM cliente where ruc=:ruc";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':ruc' => $ruc));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO cliente(ruc,razsocial,contacto,telefono,correo,direccion, avatar) VALUES (:ruc,:razsocial,:contacto,:telefono,:correo,:direccion, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':ruc' => $ruc,':razsocial' => $razsocial,':contacto'=>$contacto ,':telefono' => $telefono,':correo' => $correo,':direccion' => $direccion,':avatar' => $avatar));
            echo 'add';
        }
    }

    function buscar(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM cliente where razsocial LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM cliente where razsocial NOT LIKE '' ORDER BY id_cliente DESC, razsocial ASC LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cambiar_avatar($id, $nombre){
        $sql = "UPDATE cliente set avatar=:nombre where id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':nombre' => $nombre));
    }

    function borrar($id){
        $sql = "DELETE FROM cliente where id_cliente=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        }else{
                echo 'noborrado';
        }
    }

    function editar($id,$ruc, $razsocial, $contacto,$telefono, $correo, $direccion){
        $sql = "SELECT id_cliente FROM cliente where id_cliente!=:id and ruc=:ruc and razsocial=:razsocial";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':ruc' => $ruc,':razsocial' => $razsocial));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql = "UPDATE cliente SET ruc=:ruc, razsocial=:razsocial, contacto=:contacto,telefono=:telefono, correo=:correo, direccion=:direccion where id_cliente=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':ruc' => $ruc,':razsocial' => $razsocial,':contacto'=>$contacto,':telefono' => $telefono, ':correo'=>$correo ,':direccion' => $direccion));
            echo 'edit';
        }
    }

    function rellenar_clientes(){
        $sql = "SELECT id_cliente,ruc,razsocial,direccion FROM cliente";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function buscar_cliente(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM cliente where ruc LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "$consulta"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
            echo 'okcli';
        } else{
            echo 'nocli';
        }
    }

}
?>