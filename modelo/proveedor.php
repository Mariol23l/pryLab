<?php
include 'Conexion.php';
class proveedor{
    var $objetos;
    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$razsocial,$telefono,$correo,$direccion,$avatar){
        $sql = "SELECT id_proveedor FROM proveedor where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre' => $nombre));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noadd';
        } else {
            $sql = "INSERT INTO proveedor(nombre,razsocial,telefono,correo,direccion, avatar) VALUES (:nombre,:razsocial,:telefono,:correo,:direccion, :avatar)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':nombre' => $nombre,':razsocial' => $razsocial,':telefono' => $telefono,':correo' => $correo,':direccion' => $direccion,':avatar' => $avatar));
            echo 'add';
        }
    }

    function buscar(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM proveedor where nombre LIKE :consulta ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM proveedor where nombre NOT LIKE '' ORDER BY id_proveedor DESC, nombre ASC LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cambiar_avatar($id, $nombre){
        $sql = "UPDATE proveedor set avatar=:nombre where id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':nombre' => $nombre));
    }

    function borrar($id){
        $sql = "DELETE FROM proveedor where id_proveedor=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        }else{
                echo 'noborrado';
        }
    }

    function editar($id,$nombre, $razsocial, $telefono, $correo, $direccion){
        $sql = "SELECT id_proveedor FROM proveedor where id_proveedor!=:id and nombre=:nombre and razsocial=:razsocial";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':nombre' => $nombre,':razsocial' => $razsocial));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noedit';
        } else {
            $sql = "UPDATE proveedor SET nombre=:nombre, razsocial=:razsocial, telefono=:telefono, correo=:correo, direccion=:direccion where id_proveedor=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id, ':nombre' => $nombre,':razsocial' => $razsocial,':telefono' => $telefono, ':correo'=>$correo ,':direccion' => $direccion));
            echo 'edit';
        }
    }
    
    function rellenar_proveedores(){
        $sql = "SELECT * FROM proveedor order by razsocial asc";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
?>