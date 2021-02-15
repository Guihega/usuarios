<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.php");
}
else
{
  require 'header.php';
  ?>
  <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">        
      <!-- Main content -->
      <section class="content-header">
        <div class="row">
          <div class="col-md-6">
            <h1>Cambiar contraseña</h1>
          </div>
        </div>
      </section>
      <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <!-- centro -->
                <form name="frmCambiarPassword" id="frmCambiarPassword" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="nombrePassword" id="nombrePassword" maxlength="100" placeholder="Nombre">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Email(*):</label>
                        <input type="email" class="form-control" name="emailPassword" id="emailPassword" maxlength="50" placeholder="Email" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 login">
                        <label>Usuario (*):</label>
                        <input type="text" class="form-control" name="loginPassword" id="loginPassword" maxlength="20" placeholder="Login">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 has-feedback password">
                        <label>Clave (*):</label>
                        <input type="password" class="form-control" name="clavePassword" id="clavePassword" maxlength="64" placeholder="Clave" required>
                        <span id="eye" class="fa fa-eye-slash form-control-feedback showPass userPasss" onclick="showHidePwd();"></span>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-sm btn-primary" type="submit" id="btnActualizarPassword"><i class="fa fa-save"></i> Guardar</button>
                      <button id="btnCancelarPassword" class="btn btn-sm btn-danger" onclick="cancelarform(2)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                    </div>
                  </div>
                </form>
            </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
  <?php
  require 'footer.php';
  ?>

  <script type="text/javascript" src="scripts/registrar.js"></script>
  <?php
}
ob_end_flush();
?>