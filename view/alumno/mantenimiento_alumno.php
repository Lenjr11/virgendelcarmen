<script src="../js/alumno.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LISTA DE ALUMNOS</h1>
    <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistroAlumno()"><i class="fas fa-plus"></i>
        Nuevo alumno</button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="tabla_alumno_simple" class="display" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>DNI/CE</th>
                        <th>Nombres</th>
                        <th>Genero</th>
                        <th>F.nacimiento</th>
                        <th>Ciudad</th>
                        <th>Celular</th>
                        <th>Direccion</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_registro_alumno"  aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Alumnos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">DNI/CE</label>
                        <input type="text" id="txt_dni" minlength="8" maxlength="8" class="form-control" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Nacionalidad</label>
                        <input type="text" id="txt_nacionalidad" value="Peruano" class="form-control" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Nombres Completos</label>
                        <input type="text" id="txt_nombre" class="form-control" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Genero</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero" style="width:100%" >
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Fecha de nacimiento</label>
                        <input type="date" max="2020-06-30" min="1953-12-30" id="txt_fecha" class="form-control" >
                    </div>
                    <div class="col-12">
                        <label for="">Celular(Opcional)</label>
                        <input type="text" id="txt_celular" minlength="9" maxlength="9" class="form-control" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Ciudad</label>
                        <input type="text" id="txt_ciudad" value="Chiclayo" class="form-control" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Dirección (Domicilio)</label>
                        <input type="text" id="txt_direccion"  maxlength="50" class="form-control" >
                    </div>
                    <div class="col-12" id="div_mensaje_error"><br>
          
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" onclick="Registrar_Alumno()">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_alumno" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="">DNI/CE</label>
                        <input type="text" id="txt_idalumno_editar" hidden>
                        <input type="text" id="txt_dni_editar" class="form-control" disabled>
                    </div>
                    <div class="col-12">
                        <label for="">Nacionalidad</label>
                        <input type="text" id="txt_nacionalidad_editar" class="form-control" disabled>
                    </div>
                    <div class="col-12">
                        <label for="">Nombres Completos</label>
                        <input type="text" id="txt_nombre_editar" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="">Fecha de nacimiento</label>
                        <input type="date" id="txt_fecha_editar" class="form-control" disabled>
                    </div>
                    <div class="col-12">
                        <label for="">Ciudad</label>
                        <input type="text" id="txt_ciudad_editar" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="">Dirección</label>
                        <input type="text" id="txt_direccion_editar" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="Modificar_Alumno()">Modificar</button>
            </div>
        </div>
    </div>
</div>

<script>
listar_alumno_serverside();
</script>