<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- SweetAlert2-->
<script src="../js/sweetalert2.js"></script>
<!-- Select2-->
<script src="../js/select2.js"></script>
</body>
<script>
    let funcion='devolver_avatar';
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
        const avatar=JSON.parse(response);
        $('#avatar3').attr('src','../img/'+avatar.avatar);
    });
    funcion='tipo_usuario'
    $.post('../controlador/UsuarioController.php',{funcion},(response)=>{
        if (response==1) {
           $('#gestion_lote').hide();
        }else if (response==2) {
            $('#gestion_lote').hide();
            $('#gestion_clientes').hide();
            $('#gestion_producto').hide();
            $('#gestion_proveedor').hide();
            $('#gestion_venta').hide();
            $('#gestion_cotizaciones').hide();
            $('#gestion_usuario').hide();
            $('#gestion_atributo').hide();
        }
    });
</script>
</html>
