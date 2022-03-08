<?php
session_start();
if ($_SESSION['us_tipo']==3) {
    include_once 'layouts/header.php';
?>
<title>GESTION LOTE</title>
<?php
    include_once 'layouts/nav.php';
    ?>
 <!-- CREAR LOTE -->
<div class="modal fade" id="editarlote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Editar Lote</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <form id="form-editar-lote">
                        <div class="form-group">
                            <label for="codigo_lote">Codigo:</label>
                            <label id="codigo_lote"></label>
                        </div>
                        <div class="form-group">
                            <label for="stock" >Stock</label>
                            <input id="stock" type="number" class="form-control" placeholder="Ingrese Stock" required min="0" max="999999999">
                        </div>
                        <div class="form-group">
                            <label for="cod_lote">Lote</label>
                            <input id="cod_lote" type="text" class="form-control" placeholder="Ingrese Stock" required>
                        </div>
                        <div class="form-group">
                            <label for="ven_lote">Fecha Vencimiento</label>
                            <input id="ven_lote" type="date" class="form-control" placeholder="Ingrese Vencimiento">
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>STOCK ACTUALIZADO AL DIA</h1>
                        <h5>Control de Medicamentos por Lote</H5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestion Lote</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Buscar Lotes</h3>
                    <div class="input-group">
                        <input id="buscar-lote" placeholder="Ingrese nombre de Producto" type="text"
                            class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="lotes" class="row d-flex align-items-stretch">

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
<script src="../js/lote.js"></script>