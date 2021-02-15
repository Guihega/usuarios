<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (isset($_SESSION["nombre"]))
{
  header("Location: usuario.php");
}
else
{
  require 'header.php';
  ?>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Ingrese sus datos de Acceso</p>
      <form id="frmAcceso">
        <div class="form-group has-feedback">
          <input type="text" id="username" class="form-control" placeholder="Usuario o Email" value="guihega@live.com.mx">
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password" class="form-control" placeholder="Contraseña" value="admin">
          <span id="eye" class="fa fa-eye-slash form-control-feedback showPass" onclick="showHidePwd();"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in icono"></i>Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <?php
    require 'footer.php';
  ?>

  <script src="scripts/login.js"></script>

  <script src="../public/js/sweetalert.min.js"></script>

  <script src="../public/js/sweetalert2.js"></script>
<?php
  }
ob_end_flush();
?>