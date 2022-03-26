<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- FavIcon-->
<link rel="icon" href="../img/logo.png" type="image/png">
<!--Animate-->
<link rel="stylesheet" href="../css/animate.min.css">
<!-- Compra-->
<link rel="stylesheet" href="../css/compra.css">
<!-- Select2-->
<link rel="stylesheet" href="../css/select2.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="../css/sweetalert2.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="../css/css/all.min.css">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Theme style -->
<link rel="stylesheet" href="../css/adminlte.min.css">
<!--Estilos para el carrito-->
<link rel="stylesheet" href="../css/main.css">
<!--Estilos para el datatable-->
<link rel="stylesheet" href="../css/datatables.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../vista/adm_catalogo.php" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown" id="cat-carrito" style="display: none;">
                    <img  src="../img/Carrito.png" class="imagen carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="FALSE" aria-expanded="FALSE">
                    <span id="contador" class="contador badge badge-danger"></span>
                    </img>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <table class=" carro table table-hover text-nowrap p-0">
                            <thead class="table bg-navy" style="text-align: center;">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Lote</th>
                                    <th>Vencimiento</th>
                                    <th>Precio</th>
                                    <th>Laboratorio</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="lista_carrito" style="text-align: center;">                               
                            </tbody>
                        </table>
                        <div style="text-align: center;">
                        <a href="#" id="procesar-pedido" class="btn bg-gradient-danger mr-0" style="margin-right:50px;">Procesar Compra</a>
                        <a href="#" id="vaciar-carrito" class="btn bg-gradient-lightblue mr-0" style="margin-right:50px;">Vaciar Lista</a>
                    </div>                   
                    </div>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <i class="fas fa-solid fa-arrow-right-from-bracket fa-lg"><a href="../controlador/Logout.php"
                        style="color: #11101d;"><span>Cerrar Sesion</span></a></i>

            </ul>
        </nav>
        <!-- /.navbar -->
        <style>
        .sidebar {
            padding: px px;
            transition: all 0.5s ease;
            height: 100%;
            background: #0F2027;
        }
        hr.solid {
  border-top: 0.4px solid #9E9998 ;
}

        </style>
        <!-- Main Sidebar Container -->
        <aside class="sidebar main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../vista/adm_catalogo.php" class="brand-link" style="text-align: center;">
                <!--<img id="" src="../img/logo.png" style="object-fit: cover; width: 30%; height: 40%;" class="brand-image img-circle elevation-3">     -->
                <span class="brand-text font-weight-light">
                    <h3><b>BIENVENIDO</b></h3>
                </span>
            </a>
            <a href="../vista/adm_catalogo.php" class="brand-link">

                <img id="avatar3" src="../img/avatar.png" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light"><b> <?php
                              echo $_SESSION['nombre_us'];
                            ?></span></b>
            </a>
            <div class="form-inline mt-3">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <hr class="solid">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="color nav nav-pills nav-sidebar flex-column mr-4" data-widget="treeview" role="menu"
                        data-accordion="false" style="color:#fff;">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">USUARIO</li>
                        <li class="nav-item">
                            <a href="editar_datos_personales.php" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Datos Personales
                                </p>
                            </a>
                        </li>
                        <li id="gestion_usuario" class="nav-item">
                            <a href="adm_usuario.php" class="nav-link">
                                <i class="nav-icon fas fa-users""></i>                        
                                <p>                               
                                    Control Usuario
                                </p>
                            </a>
                            <li class="nav-header">CLINICAS</li>
                        <li  id="gestion_clientes" class="nav-item">
                            <a href="adm_cliente.php" class="nav-link">
                                <i class="nav-icon fas fa-hospital-user"></i>
                                <p>
                                    Clientes SIS-FISSAL
                                </p>
                            </a>
                        </li>
                         <li class=" nav-header">ALMACEN</li>
                        <li  id="gestion_producto" class="nav-item">
                            <a href="adm_producto.php" class="nav-link">
                                <i class="nav-icon fas fa-pills"></i>
                                <p>
                                    Gestion Producto
                                </p>
                            </a>
                        </li>
                        <li  id="gestion_atributo" class="nav-item">
                            <a href="adm_atributo.php" class="nav-link">
                                <i class="nav-icon fas fa-vials"></i>
                                <p>
                                    Gestion Atributo
                                </p>
                            </a>
                        </li>
                        <li  id="gestion_lote" class="nav-item">
                            <a href="adm_lote.php" class="nav-link">
                                <i class="nav-icon fas fa-cubes"></i>
                                <p>
                                    Actualizar Lotes
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">COMPRAS</li>
                        <li  id="gestion_proveedor" class="nav-item">
                            <a href="adm_proveedor.php" class="nav-link">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Gestion de Proveedores
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">VENTAS</li>
                        <li  id="gestion_venta" class="nav-item">
                            <a href="adm_venta.php" class="nav-link">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Listar Ventas
                                </p>
                            </a>
                        </li>
                        <li  id="gestion_cotizaciones" class="nav-item">
                            <a href="adm_cotizaciones.php" class="nav-link">
                                <i class="nav-icon fas fa-list-check"></i>
                                <p>
                                    Listar Cotizaciones
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">ENCOMIENDAS</li>
                        <li class="nav-item">
                            <a href="adm_cotizaciones.php" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Envios a Departamentos
                                </p>
                            </a>
                        </li>
                        <!--                 
                        <li class="nav-header">CALENDARIO</li>
                        <li class="nav-item">
                            <a id="ea" href="../cliente.js" class="nav-link">
                                <i class="nav-icon fas fa-calendar-plus"></i>
                                <p>
                                    Eventos Anuales
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Metas Mensuales
                                </p>
                            </a>
                        </li>
    -->
                    </ul>

                </nav>

                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>