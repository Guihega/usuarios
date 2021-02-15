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
            <h1>Usuario</h1>
          </div>
          <div class="col-md-6">
            <div class="box-tools pull-right exportButtons">
            </div>
            <div class="box-tools pull-right btnAcciones">
              <button class="btn btn-sm btn btn-success" id="btnagregar" onclick="mostrarform(true,1)"><i class="fa fa-plus-circle"></i> Agregar</button>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Telefono</th>
                      <th>Email</th>
                      <th>Usuario</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                    </thead>
                    <tbody>                            
                    </tbody>
                    <tfoot>
                      <th>Opciones</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Telefono</th>
                      <th>Email</th>
                      <th>Usuario</th>
                      <th>Imagen</th>
                      <th>Estado</th>
                    </tfoot>
                  </table>
                </div>
                <!--Fin centro -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <!-- Modal -->
    <div class="modal fade" id="modalNuevoUsuario" aria-modal="true">
      <form name="formulario" id="formulario" method="POST">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nuevo usuario</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
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
                  <label>Contrseña (*):</label>
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
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <button id="btnCancelar" class="btn btn-sm btn-danger" onclick="cancelarform(1)" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </form>
    </div>
    <!-- Fin modal -->
    <div class="modal fade" id="modalCambiarPassword" aria-modal="true">
      <form name="formularioPass" id="formularioPass" method="POST">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Nombre(*):</label>
                <input type="text" class="form-control" name="nombrePassword" id="nombrePassword" maxlength="100" placeholder="Nombre" required>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Email:</label>
                <input type="email" class="form-control" name="emailPassword" id="emailPassword" maxlength="50" placeholder="Email">
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 login">
                <label>Login (*):</label>
                <input type="text" class="form-control" name="loginPassword" id="loginPassword" maxlength="20" placeholder="Login" required>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </form>
    </div>
  <?php
  require 'footer.php';
  ?>

  <script type="text/javascript" src="scripts/usuario.js"></script>
  <?php
}
ob_end_flush();
?>