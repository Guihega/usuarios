u<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/animate.min.css">

    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.css">
    <link href="../public/css/_all-skins.min.css" rel="stylesheet" type="text/css">
    <!-- DATATABLES -->
    <link href="../public/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="../public/css/sweetalert2.min.css">
  </head>

 <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="usuario.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>REGISTRO</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>REGISTRO</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Navegación</span>
            </a>
            <?php 
            if (isset($_SESSION["nombre"]))
            {
                echo '<div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                      <li class="dropdown notifications-menu">
                        <a href="../vistas/registrar.php"><i class="fa fa-user-plus icono"></i>Registrar</a>
                      </li>
                      <!-- Tasks: style can be found in dropdown.less -->
                      <li class="dropdown tasks-menu">
                        <a href="../vistas/cambiarpassword.php"><i class="fa fa-key icono"></i>Cambiar Contraseña</a>
                      </li>
                      <!-- User Account: style can be found in dropdown.less -->
                      <li class="dropdown user user-menu">
                        <div class="p-dropdown">
                            <a href="#" class="btn btn-light btn-round" data-toggle="dropdown">
                              <img src="../files/usuarios/'.$_SESSION["imagen"].'"'. 'class="user-image" alt="User Image">
                            </a>
                            <div class="p-dropdown-content">
                              <div class="widget-myaccount">
                                  <div class="d-block">
                                    <img src="../files/usuarios/'.$_SESSION['imagen'].'"'. 'class="img-circle" alt="User Image">
                                  </div>
                                  <span class="hidden-xs">'.$_SESSION['nombre'].'</span>
                                  <ul class="text-center">
                                    <li><a href="../ajax/usuario.php?op=salir"><i class="icon-log-out"></i>Cerrar</a></li>
                                  </ul>
                              </div>
                            </div>
                          </div>
                      </li>
                    </ul>
                </div>';
            }
            ?>
        </nav>
      </header>