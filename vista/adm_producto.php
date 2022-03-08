<?php
session_start();
if ($_SESSION['us_tipo'] == 1  || $_SESSION['us_tipo']==3) {
    include_once 'layouts/header.php';
?>
<title>Editar Datos</title>
<?php
    include_once 'layouts/nav.php';
    ?>
<!-- CREAR LOTE -->
<div class="modal fade" id="crearlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Lote</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id="add_lote" style='display: none;'>
                        <span><i class="fas fa-check m-2"></i>Se agrego correctamente el Lote</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noadd_lote" style='display: none;'>
                        <span><i class="fas fa-times m-2"></i>El lote esta siendo usado en otro producto</span>
                    </div>
                    <form id="form-crear-lote">
                        <div class="form-group">
                            <label for="nombre_producto_lote">Producto: </label>
                            <label id="nombre_producto_lote"></label>
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor: </label>
                            <select name="presentacion" id="proveedor" class="form-control select2-cyan" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="stock" >Stock</label>
                            <input id="stock" type="number" class="form-control" placeholder="Ingrese Stock" required min="0" max="999999999">
                        </div>
                        <div class="form-group">
                            <label for="codlote">Lote</label>
                            <input id="codlote" type="text" class="form-control" placeholder="Ingrese Stock" required>
                        </div>
                        <div class="form-group">
                            <label for="vencimiento">Fecha Vencimiento</label>
                            <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese Vencimiento">
                        </div>
                        <input type="hidden" id="id_lote_prod">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-cyan float-right m-1">Guardar</button>
                    <button type="button" data-dismiss="modal"
                        class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--MODAL CAMBIA FOTO-->
<div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <h2>&times;</h2>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="logoactual" src="../img/avatar.png" alt="avatar" class="profile-user-img img-fluid img-circle">
                </div>
                <div class="text-center">
                    <b id="nombre_logo">
                    </b>
                </div>
                <div class="alert alert-success text-center" id="editlogo" style='display: none;'>
                    <span><i class="fas fa-check m-2"></i>Se cambio el Logo</span>
                </div>
                <div class="alert alert-danger text-center" id="noeditlogo" style='display: none;'>
                    <span><i class="fas fa-times m-2"></i>Solo se admite formato jpg/png/gif</span>
                </div>
                <!-- permite colocar imagnes   ↓↓↓  -->   
                <form id="form-logo" enctpy="multipart/form-data">
                    <div class="input-group mb-3 ml-5 mt-2">
                        <input type="file" name="foto" class="input-group">
                        <input type="hidden" name="funcion" id="funcion">
                        <input type="hidden" name="id_logo_prod" id="id_logo_prod">
                        <input type="hidden" name="avatar" id="avatar">
                    </div>           
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary " data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn bg-gradient-primary w-33">Guardar cambios</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--MODAL CAMBIA FOTO-->
<!-- Button trigger modal -->
<div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Producto</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id="add-prod" style='display: none;'>
                        <span><i class="fas fa-check m-2"></i>Se agrego correctamente el Producto</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noadd-prod" style='display: none;'>
                        <span><i class="fas fa-times m-2"></i>El Producto ya existe</span>
                    </div>
                    <div class="alert alert-success text-center" id="editprod" style='display: none;'>
                    <span><i class="fas fa-check m-2"></i>Se edito correctamente</span>
                </div>
                    <form id="form-crear-producto">
                        <div class="form-group">
                            <label for="nombre_producto">Nombre Producto</label>
                            <input id="nombre_producto" type="text" class="form-control" placeholder="Ingrese Producto" required>
                        </div>
                        <div class="form-group">
                            <label for="concentracion">Concentracion</label>
                            <input id="concentracion" type="text" class="form-control" placeholder="Ingrese Concentracion" required>
                        </div>
                        <div class="form-group">
                            <label for="adicional">Adicional</label>
                            <input id="adicional" type="text" class="form-control" placeholder="Ingrese adicional Campo Requerido" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input id="precio" type="number" class="form-control" value='1' placeholder="Ingrese precio del Producto" step="0.01" min="0" max="10" required>
                        </div>
                        <div class="form-group">
                            <label for="laboratorio">Laboratorio</label>
                            <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control select2" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <label for="presentacion">Presentacion</label>
                            <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%;"></select>
                        </div>
                        <input type="hidden" id="id_edit_prod">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-gradient-cyan float-right m-1">Guardar</button>
                    <button type="button" data-dismiss="modal"
                        class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestion Producto 
                        <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-blue ml-2">
                            Crear Producto
                        </button>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                        <li class="breadcrumb-item active">Gestion Producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Buscar Producto</h3>
                    <div class="input-group">
                        <input id="buscar-producto" placeholder="Ingrese nombre de Producto" type="text"
                            class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="productos" class="row d-flex align-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>
<script src="../js/producto.js"></script>