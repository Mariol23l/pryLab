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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section >
    <div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h1 style="text-align: center;">ESTAMOS TRABAJANDO EN ELLO.......</h1>
        <h1 style="text-align: center; font-size: 100px;"><i class="fa-solid fa-screwdriver-wrench"></i></h1>
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