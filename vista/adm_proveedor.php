<?php
session_start();
if ($_SESSION['us_tipo'] == 1  || $_SESSION['us_tipo']==3) {
    include_once 'layouts/header.php';
?>
<title>Editar Datos</title>
<?php
    include_once 'layouts/nav.php';
    ?>
Copy
<!-- Button trigger modal -->
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
                    <img id="logoactual" src="../img/avatar.png" alt="avatares" class="profile-user-img img-fluid img-circle">
                </div>
                <div class="text-center">
                    <b id="nombre_logo">
                    </b>
                </div>
                <div class="alert alert-success text-center" id="edit-prov" style='display: none;'>
                    <span><i class="fas fa-check m-2"></i>Se edito el Logo</span>
                </div>
                <div class="alert alert-danger text-center" id="noedit-prov" style='display: none;'>
                    <span><i class="fas fa-times m-2"></i>Solo se admite formato jpg/png/gif</span>
                </div>
                <!-- permite colocar imagnes   ↓↓↓  -->   
                <form id="form-logo" enctpy="multipart/form-data">
                    <div class="input-group mb-3 ml-5 mt-2">
                        <input type="file" class="input-group" name="foto">
                        <input type="hidden" name="funcion" id="funcion">
                        <input type="hidden" name="id_edit_prov" id="id_edit_prov">
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

<div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Crear Proveedor</h3>
                    <button data-dismiss="modal" aria-label="close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="alert alert-success text-center" id="addprov" style='display: none;'>
                        <span><i class="fas fa-check m-2"></i>Se agrego correctamente el Proveedor</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noaddprov" style='display: none;'>
                        <span><i class="fas fa-times m-2"></i>El proveedor ya existe</span>
                    </div>
                    <div class="alert alert-success text-center" id="editprov" style='display: none;'>
                        <span><i class="fas fa-user-check m-2"></i>Se actualizo el Proveedor</span>
                    </div>
                    <form id="form-crear">
                        <div class="form-group">
                            <label for="nombre">Nombres</label>
                            <input id="nombre" type="text" class="form-control" placeholder="Ingrese nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="razsocial">Razon Social</label>
                            <input id="razsocial" type="razsocial" class="form-control" placeholder="Ingrese Razon Social" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input id="telefono" type="number" class="form-control" placeholder="Ingrese Telefono" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo</label>
                            <input id="correo" type="email" class="form-control" placeholder="Ingrese correo">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input id="direccion" type="direccion" class="form-control" placeholder="Ingrese Direccion" required>
                        </div>
                        <input type="hidden" id="id_edit_proveedor">

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
                    <h1>Gestion de Proveedores <button type="button" data-toggle="modal"
                            data-target="#crearproveedor" class="btn bg-gradient-blue ml-2">
                            Crear Proveedor<i class="fas fa-solid fa-user-plus ml-2"></i></button>
                        </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
                        <li class="breadcrumb-item active">Gestion Proveedor</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section>
        <div class="container-fluid">
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">Buscar Proveedor</h3>
                    <div class="input-group">
                        <input id="buscar_proveedor" placeholder="Ingrese nombre de Proveedor" type="text"
                            class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="proveedores" class="row d-flex align-items-stretch">

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
<script src="../js/proveedor.js"></script>