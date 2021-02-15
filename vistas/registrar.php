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
            <h1>Agregar usuario</h1>
          </div>
        </div>
      </section>
      <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <!-- centro -->
                <form name="frmRegistrar" id="frmRegistrar" method="POST">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Nombre(*):</label>
                        <input type="hidden" name="idusuario" id="idusuario">
                        <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" maxlength="70">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" maxlength="20" placeholder="Teléfono">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" id="email" maxlength="50" placeholder="Email">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 login">
                        <label>Usuario (*):</label>
                        <input type="text" class="form-control" name="login" id="login" maxlength="20" placeholder="Login" required>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 has-feedback password">
                        <label>Contraseña (*):</label>
                        <input type="password" class="form-control" name="clave" id="clave" maxlength="64" placeholder="Clave" required>
                        <span id="eye" class="fa fa-eye-slash form-control-feedback showPass userPasss" onclick="showHidePwd();"></span>
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Imagen:</label>
                        <input type="file" class="form-control" name="imagen" id="imagen">
                        <input type="hidden" name="imagenactual" id="imagenactual">
                      </div>
                      <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <img src="" width="150px" height="150px" id="imagenmuestra" class="imagenmuestra">
                      </div>
                      <button class="btn btn-sm btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                      <button id="btnCancelar" class="btn btn-sm btn-danger" onclick="cancelarform(1)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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