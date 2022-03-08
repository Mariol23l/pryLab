<?php
session_start();
if($_SESSION['us_tipo']==1 || $_SESSION['us_tipo']==3 ){
    include_once 'layouts/header.php';
?>
<title>MERLYN | Venta</title>
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
                    <h>Venta</h1>
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
    <!--PLANTILLA VENTA-->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-navy">
                        <div class="card-header">
                        </div>
                        <div class="card-body p-0" style="border-style: solid;">
                            <div class="logo_cp">
                                <img src="../img/logo.png" width="100" height="100">
                                <div class="titulo_cp">
                                    <span>DI MERLYN</span><br>
                                    <span>UNIDAD INMOBILIARIA 8 URB. SANTA ROSITA DE ATE III E MZA. P LOTE.</span><br>
                                    <span>10 INT. PS5 CRUZANDO LAS LINEAS DEL FERROCARRIL</span><br>
                                    <span>ATE - LIMA - LIMA</span>
                                </div>
                                <div class="correlativo">
                                    <h6>FACTURA ELECTRONICA</h6>
                                    <h6>20602414052</h6>
                                </div>
                            </div>

                            <div class="datos_cp">
                                <div class="form-group row mt-1">
                                    <span>Forma de Pago:</span>
                                    <select name="laboratorio" id="laboratorio" class="form-control select2"
                                        style="width: 15%;  -webkit-text-stroke: 1px black; border-style: none; border-bottom: solid;"
                                        required>
                                        <option value="1">Credito</option>
                                        <option value="2">Contado</option>
                                    </select>
                                </div>
                                
                                <div class="form-group row">
                                    <span>Fecha Emision: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="date" class="form-control" id="fecha"
                                            value="<?php echo date("Y-m-d");?>" placeholder="Ingresa Fecha de Emision">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>RUC: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="ruc_cliente" maxlength="14" minlength="14" placeholder="Ingresar RUC" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>Razon Social: </span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="razsocial_cliente" placeholder="Ingresar RazonSocial" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span>Direccion del Cliente:</span>
                                    <div class="input-group-append col-md-6">
                                        <input type="text" class="form-control" id="direccion_cliente"
                                            placeholder="Ingresar Direccion" required>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <span>Vendedor: </span>
                                    <h3>usuario</h3>
                                </div>
                            </div>
                            </header>
                            <!--<button id="actualizar"class="btn btn-success">Actualizar</button>-->
                            <div id="cpro" class="card-body p-0">
                                <table class="compra table table-hover text-nowrap">
                                    <thead class='table-success'>
                                        <tr class="bg-navy">
                                            <th scope="col">Producto</th>
                                            <th scope="col">Lote</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Vencimiento</th>
                                            <th scope="col">Presentacion</th>
                                            <th scope="col">Laboratorio</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Sub Total</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="lista-compra" class='table-active'>
                                    </tbody>
                                </table>
                                <div class="row" style="position:relative; margin-top: 10px;">
                                    <!--
                                        <div class="col-md-4">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-cash-register"></i>
                                                        Cambio
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="info-box mb-3 bg-success">
                                                        <span class="info-box-icon"><i
                                                                class="fas fa-money-bill-alt"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-left ">INGRESO</span>
                                                            <input type="number" id="pago" min="1"
                                                                placeholder="Ingresa Dinero" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="info-box mb-3 bg-info">
                                                        <span class="info-box-icon"><i
                                                                class="fas fa-money-bill-wave"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-left ">VUELTO</span>
                                                            <span class="info-box-number" id="vuelto">3</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-default">
                                                <div class="card-header">
                                                    <h3 class="card-title">
                                                        <i class="fas fa-bullhorn"></i>
                                                        Calculo 2
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="info-box mb-3 bg-danger">
                                                        <span class="info-box-icon"><i
                                                                class="fas fa-comment-dollar"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-left ">DESCUENTO</span>
                                                            <input id="descuento" type="number" min="1"
                                                                placeholder="Ingrese descuento" class="form-control">
                                                        </div>
                                                    </div>
                                                
                                                    
                                                </div>
                                            </div>
                                        </div>
    -->

                                        

                                    <div class="datos col-md-4">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    <i class="fas fa-dollar-sign"></i>
                                                    Calculo 1
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="info-box mb-3 bg-warning p-0">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">SUB TOTAL</span>
                                                        <span class="info-box-number" id="subtotal">10</span>
                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-warning">
                                                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text text-left ">IGV</span>
                                                        <span class="info-box-number" id="con_igv">2</span>
                                                    </div>
                                                </div>
                                                <div class="info-box mb-3 bg-info">
                                                        <span class="info-box-icon"><i
                                                                class="ion ion-ios-cart-outline"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-left ">TOTAL</span>
                                                            <span class="info-box-number" id="total">12</span>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="aumentar col-md-4 mb-2">
                                    <a href="../vista/adm_catalogo.php" class="btn btn-primary btn-block">Seguir
                                        comprando</a>
                                </div>
                                <div class="venta col-xs-12 col-md-4">
                                    <a href="#" class="btn btn-success btn-block" id="procesar-compra">Realizar
                                        compra</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include_once 'layouts/footer.php';
}else{
     header('Location: ../index.php');
}
?>
<script src="../js/carrito.js"></script>