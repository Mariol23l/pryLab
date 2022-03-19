<?php
session_start();
if ($_SESSION['us_tipo']==2) {
?>
<title>CATALAGO | TEC</title>
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
            <h1>ACTIVIDAD | TEC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="tec_catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Actividades</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Registro De Horarios-->
<section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Registro Horarios</h3>                  
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table">
                            <tr style="text-align: center;">
                                <th>Dia</th>
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
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Start creating your amazing application!
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

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