<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3 ){
    include_once 'layouts/header.php';
?>
<title>MERLYN | Catalogo</title>
<?php
    include_once 'layouts/nav.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalogo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Catalogo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!--BUSCADOR FACTURAS POR VENCER-->
<section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Facturas por Vencer</h3>                  
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="animate__animated animate__backInDown table table-hover text-nowrap">
                        <thead class="table">
                            <tr style="text-align: center;">
                                <th>Codigo</th>
                                <th>R.U.C</th>
                                <th>Clinica</th>
                                <th>Tipo Pago</th>
                                <th>Total S/.</th>                              
                                 <th>Fecha Emision</th>
                                 <th>Fecha Vencimiento</th>
                                 <th>Vendedor</th>
                            </tr>
                        </thead>
                        <tbody id="fac" class="table-active">
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </section>
<!--BUSCADOR DE LOTES EN RIESGO-->
<section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Buscar Lotes en Riesgo</h3>                  
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="animate__animated animate__backInDown table table-hover text-nowrap">
                        <thead class="table">
                            <tr style="text-align: center;">
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Lote</th>
                                <th>Vencimiento</th>                              
                                 <th>Mes</th>
                                 <th>Dia</th>
                                 <th>Laboratorio</th>
                                <th>Proveedor</th>
                                <th>Presentacion</th>
                            </tr>
                        </thead>
                        <tbody id="lot" class="table-active">

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include_once 'layouts/footer.php';
}else{
     header('Location: ../index.php');
}
?>
<script src="../js/catalogo.js"></script>
<script src="../js/carrito.js"></script>