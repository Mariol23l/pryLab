<?php
session_start();
if ($_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==1) {
    include_once 'layouts/header.php';
?>
<title>GESTION VENTA</title>
<?php
    include_once 'layouts/nav.php';
    ?>
<!-- CREAR LOTE -->

<div class="modal fade" id="vista_venta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Detalle Venta</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="codigo_venta">Codigo Venta:</label>
                        <span id="codigo_venta"></span>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha Venta:</label>
                        <span id="fecha"></span>
                    </div>
                    <div class="form-group">
                        <label for="ruc">RUC:</label>
                        <span id="ruc"></span>
                    </div>
                    <div class="form-group">
                        <label for="razonsocial">Razon Social:</label>
                        <span id="razonsocial"></span>
                    </div>
                    <div class="form-group">
                        <label for="vendedor">Vendedor</label>
                        <span id="vendedor"></span>
                    </div>
                    <table class="table table-hover text-nowrap">
                        <thead class="table bg-navy">
                            <tr style="text-align:center;">
                                <th>Producto</th>
                                <th>Laboratorio</th>
                                <th>Presentacion</th>
                                <th>Cantidad</th>
                                <th>Precio Venta S/.</th>
                                <th>Subtotal S/.</th>
                            </tr>
                        </thead>
                        <tbody class="table-warning" id="registros">

                        </tbody>
                    </table>
                    <div class="float-right input-group-append">
                        <h4 class="mt-4">Total: S/.</h4>
                        <h4 class="mt-4" id="total"></h4>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" data-dismiss="modal"
                        class="btn btn-outline-secondary float-right m-1">Cerrar</button>
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
                    <h1>GESTIO VENTAS</h1>
                    <h5>Listado de Ventas</H5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestion Ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--Seccion contabilidad-->
    <section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Consultas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="producto_mas_vendido"></h3>

                                    <p>Producto mas Vendido</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-pills"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="Venta Diaria"></h3>

                                    <p>Venta Diaria</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-truck-medical"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="Venta Mensual"></h3>

                                    <p>Venta Mensual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="Venta _Anual"></h3>

                                    <p>Venta_Anual</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-signal"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
    <!--Seccion Ventas-->
    <section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Buscar Ventas</h3>
                </div>
                <div class="card-body">
                    <table id="tabla_venta" class="display table table-hover text-nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>IDVenta</th>
                                <th>Fecha Venta</th>
                                <th>RUC</th>
                                <th>Razon Social</th>
                                <th>Monto Total</th>
                                <th>Vendedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
<script src="../js/datatables.js"></script>
<script src="../js/venta.js"></script>