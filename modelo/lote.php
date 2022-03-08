
<?php
include_once 'Conexion.php';
class lote{
    var $objetos;

    public function __construct(){
        $db=new Conexion();
        $this->acceso=$db->pdo;
    }

    function crear($id_producto, $proveedor, $stock, $vencimiento,$codlote){
        $sql = "SELECT id_lote FROM lote where lote=:lote";
        $query=$this->acceso->prepare($sql);
        $query->execute(array(':lote'=>$codlote));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            echo 'noaddlote';
        } else {
            $sql = "INSERT INTO lote (stock,vencimiento,lote,lote_id_prod,lote_id_prov ) values (:stock, :vencimiento, :lote, :id_producto, :proveedor)";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':stock'=>$stock,':vencimiento'=>$vencimiento,':lote'=>$codlote,':id_producto'=>$id_producto,':proveedor'=>$proveedor));
            echo 'addlote';
        }
    }

    function buscar(){
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT id_lote, stock,lote_id_prod, lote,vencimiento,concentracion, adicional,producto.nombre as prod_nombre, laboratorio.nombre as lab_nombre, tipo_producto.nombre as tip_nom, presentacion.nombre pre_nom, proveedor.nombre as proveedor, producto.avatar as logo, precio FROM lote
            join proveedor on lote_id_prov=id_proveedor
            join producto on lote_id_prod=id_producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion
            and producto.nombre LIKE :consulta order by producto.nombre limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT id_lote, lote_id_prod, stock, lote,vencimiento,concentracion, adicional,producto.nombre as prod_nombre, laboratorio.nombre as lab_nombre, tipo_producto.nombre as tip_nom, presentacion.nombre pre_nom, proveedor.nombre as proveedor, producto.avatar as logo, precio FROM lote
            join proveedor on lote_id_prov=id_proveedor
            join producto on lote_id_prod=id_producto
            join laboratorio on prod_lab=id_laboratorio
            join tipo_producto on prod_tip_prod=id_tip_prod
            join presentacion on prod_present=id_presentacion
            and producto.nombre NOT LIKE '' order by producto.nombre limit 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function editar($id_lote, $stock, $vencimiento,$codlote){
        $sql="UPDATE lote SET stock=:stock,vencimiento=:vencimiento,lote=:codlote where id_lote=:id";
        $query= $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_lote,':stock'=>$stock,':vencimiento'=>$vencimiento,':codlote'=>$codlote));
        echo 'edit';
    }

    function borrar($id){
        $sql = "DELETE FROM lote where id_lote=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        if (!empty($query->execute(array(':id' => $id)))) {
            echo 'borrado';
        }else{
                echo 'noborrado';
        }
    }
    function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
        $sql = "SELECT * FROM lote where id_lote=:id_lote ";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_lote'=>$id_lote));
        $lote = $query->fetchall();
        if (!empty($lote)) {
            $sql="UPDATE lote SET stock=stock+:cantidad where id_lote=:id_lote";
            $query= $this->acceso->prepare($sql);
            $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
        }else{
             #Crea nuevo Lote, no aplica en este caso ↑↑ Solo aplica  el primer caso
            $sql = "SELECT * FROM lote where vencimiento=:vencimiento and lote_id_prod=:producto and lote_id_prov=:proveedor ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
            $lote_nuevo = $query->fetchall();
            foreach ($lote_nuevo as $objeto) {
                $id_lote_nuevo=$objeto->id_lote;
            }     
            if (!empty($lote_nuevo)) {
                $sql="UPDATE lote SET stock=stock+:cantidad where id_lote=:id_lote_nuevo";
                $query= $this->acceso->prepare($sql);
                $query->execute(array(':cantidad'=>$cantidad,':id_lote_nuevo'=>$id_lote_nuevo));
            }else{
                $sql="INSERT INTO lote (id_lote,stock,vencimiento,lote_id_prod,lote_id_prov) values (:id_lote,:stock,:vencimiento,:producto,:proveedor)";
                $query= $this->acceso->prepare($sql);
                $query->execute(array(':id_lote'=>$id_lote,':stock'=>$cantidad,':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
            }
        }
    }

 }
?>