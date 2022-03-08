<?php
session_start();
if ($_SESSION['us_tipo'] == 1 || $_SESSION['us_tipo']==3 || $_SESSION['us_tipo']==2) {
    include_once 'layouts/header.php';
?>
<title>Editar Datos</title>
<?php
    include_once 'layouts/nav.php';
    ?>
Copy
<!-- Button trigger modal -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <h2>&times;</h2>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="avatar4" src="../img/avatar.png" alt="avatar" class="profile-user-img img-fluid img-circle">
                </div>
                <div class="text-center">
                    <b>
                        <?php
                        echo $_SESSION['nombre_us'];
                        ?>
                    </b>
                </div>
                <div class="alert alert-success text-center" id="update" style='display: none;'>
                    <span><i class="fas fa-check m-2"></i>Se actualizo password correctamente</span>
                </div>
                <div class="alert alert-danger text-center" id="noupdate" style='display: none;'>
                    <span><i class="fas fa-times m-2"></i>El password no es correcto</span>
                </div>
                <form id="form-pass">
                    <div class="input-group mb-3">
                        <!-- prepend para colocar en misma fila -->
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input type="password" id="oldpass" class="form-control" placeholder="Ingrese password actual">
                    </div>
                    <div class="input-group mb-3">
                        <!-- prepend para colocar en misma fila -->
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="text" id="newpass" class="form-control" placeholder="Ingrese password nueva">
                    </div>
            </div>
            <div class="modal-footer justify-content-lg-center">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-gradient-primary" id="guardar">Guardar cambios</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="cambiarfoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <h2>&times;</h2>
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="avatar1" src="../img/avatar.png" alt="avatar" class="profile-user-img img-fluid img-circle">
                </div>
                <div class="text-center">
                    <b>
                        <?php
                        echo $_SESSION['nombre_us'];
                        ?>
                    </b>
                </div>
                <div class="alert alert-success text-center" id="edit" style='display: none;'>
                    <span><i class="fas fa-check m-2"></i>Se cambio el avatar</span>
                </div>
                <div class="alert alert-danger text-center" id="noedit" style='display: none;'>
                    <span><i class="fas fa-times m-2"></i>Solo se admite formato jpg, png o gif</span>
                </div>
                <!-- permite colocar imagnes   ↓↓↓  -->   
                <form id="form-foto" enctpy="multipart/form-data">
                    <div class="input-group mb-3 ml-5 mt-2">
                        <input type="file" class="input-group" name="foto">
                        <input type="hidden" name="funcion" value="cambiar_foto">
                    </div>           
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary " data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn bg-gradient-primary w-33">Guardar cambios</button>
            </div>
            </form>
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
                    <h1>Datos Personales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
                        <li class="breadcrumb-item active">Datos Personales</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-success card-outline">
                            <dvi class="card-body box-profile">
                                <div class="text-center">
                                    <img id="avatar2" src="../img/avatar.png" class="profile-user-img img-fluid img-circle"
                                        alt="avatar">
                                </div>
                                <div class="text-center mt-1">
                                    <button type='button' data-toggle="modal" data-target="#cambiarfoto" class="btn btn-primary btn-sm">Cambiar avatar</button>
                                </div>
                                <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="nombre_us" class="profile-username text-center text-success">dfgf</h3>
                                <p id="apellidos_us" class="text-muted text-center">aasd</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b style="color: #0B7300">Edad</b><a id="edad" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color: #0B7300">DNI</b><a id="dni_us" class="float-right">12</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b style="color: #0B7300">Tipo Usuario</b>
                                        <span id="us_tipo" class="float-right">Administrador</span>
                                    </li>
                                    <button data-toggle="modal" data-target="#exampleModal" type="button"
                                        class="btn btn-block bg-gradient-lightblue">Cambiar password</button>
                                </ul>
                            </dvi>
                        </div>
                        <div class="card card-navy">
                            <div class="card-header">
                                <h3 class="card-title">Sobre mi</h3>
                            </div>
                            <div class="card-body">
                                <strong style="color: #0B7300">
                                    <i class="fas fa-phone mr-1"></i>Telefono
                                </strong>
                                <p id="telefono_us" class="text-muted">923305277</p>
                                <strong style="color: #0B7300">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Residencia
                                </strong>
                                <p id="residencia_us" class="text-muted">923305277</p>
                                <strong style="color: #0B7300">
                                    <i class="fas fa-at mr-1"></i>Correo
                                </strong>
                                <p id="correo_us" class="text-muted">923305277</p>
                                <strong style="color: #0B7300">
                                    <i class="fas fa-smile mr-1"></i>Sexo
                                </strong>
                                <p id="sexo_us" class="text-muted">923305277</p>
                                <strong style="color: #0B7300">
                                    <i class="fas fa-pencil-alt mr-1"></i>Informacion Adicional
                                </strong>
                                <p id="adicional_us" class="text-muted">923305277</p>
                                <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Click para Editar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-navy">
                            <div class="card-header">
                                <h3 class="card-title">Editar Datos Personales</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success text-center" id="editado" style='display: none;'>
                                    <span><i class="fas fa-check m-2"></i>Usuario Actualizado</span>
                                </div>
                                <div class="alert alert-danger text-center" id="noeditado" style='display: none;'>
                                    <span><i class="fas fa-times m-2"></i>Edicion Invalida</span>
                                </div>
                                <form id='form-usuario' class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                                        <div class="col-sm-10">
                                            <input type="number" maxlength="9"
                                                oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                id="telefono" class="form-control"
                                                placeholder="Debes introducir un numero">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="residencia" class="col-sm-2 col-form-label">Residencia</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="residencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="correo" class="form-control"
                                                placeholder="ejmplos_23@hotmail.com">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="sexo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Informacion
                                            Adicional</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="" id="adicional" cols="30"
                                                rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 float-right">
                                            <button class="btn btn-block bg-gradient-navy" id="enviar">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Guardar Datos</p>
                            </div>
                        </div>
                    </div>
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
<script src="../js/usuario.js"></script>