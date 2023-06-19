<script src="../js/usuario.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LISTA DE USUARIOS</h1>
    <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistroUsuario()"><i class="fas fa-plus"></i> Nuevo usuario</button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="tabla_usuario_simple" class="display" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Username</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_registro_usuario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <label for="">Nombre</label>
            <input type="text" id="txt_nombre" class="form-control" onkeypress="return soloLetras(event)">
          </div>
          <div class="col-12">
            <label for="">Apellidos</label>
            <input type="text" id="txt_apellido" class="form-control" onkeypress="return soloLetras(event)">
          </div>
          <div class="col-12">
            <label for="">Username</label>
            <input type="text" id="txt_usuario" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Email</label>
            <input type="email" id="txt_email" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Contraseña</label>
            <input type="password" id="txt_contra" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Tel/cel</label>
            <input type="text" id="txt_telefono" class="form-control" onkeypress="return soloNumeros(event)">
          </div>
          <div class="col-12" hidden>
            <label for="">Fecha</label>
            <input type="date" id="txt_fecha" value="<?php echo date("Y-m-d");?>" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Rol</label>
            <select class="js-example-basic-single" id="select_rol" style="width:100%">
            </select>
          </div>
          <div class="col-12" id="div_mensaje_error"><br>
          
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="Registrar_Usuario()">Registrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <label for="">Nombre</label>
            <input type="text" id="txt_idusuario_editar" hidden>
            <input type="text" id="txt_nombre_editar" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Apellidos</label>
            <input type="text" id="txt_apellido_editar" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Username</label>
            <input type="text" id="txt_usuario_editar" class="form-control" disabled>
          </div>
          <div class="col-12">
            <label for="">Correo</label>
            <input type="text" id="txt_email_editar" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Tel/cel</label>
            <input type="text" id="txt_telefono_editar" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Rol</label>
            <select class="js-example-basic-single" id="select_rol_editar" style="width:100%">
            </select>
          </div>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="Modificar_Usuario()">Modificar</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_contra" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar contraseña del usuario: <label for=""
        id="lbl_usuario_contra"></label></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-12">
            <input type="text" id="idusuariocontra" hidden>
            <label for="">Nueva contraseña</label><br>
            <input type="password" id="txt_contra_nueva" class="form-control">
          </div>
          <div class="col-12">
            <label for="">Confirmar contraseña</label><br>
            <input type="password" id="txt_contra_repetir" class="form-control">
          </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="Modificar_Contra_Usuario()">Modificar</button>
        </div>
      </div>
    </div>
</div>

<script>
    listar_usuario_serverside();
    cargar_select_rol();
</script>