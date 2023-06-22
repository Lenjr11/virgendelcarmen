<script src="../js/apoderado.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LISTA DE PADRES-APODERADOS</h1>
    <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistroApoderado()"><i
            class="fas fa-plus"></i>
        Nuevo ingreso</button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="tabla_apoderado_simple" class="display" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>DNI Mamá</th>
                        <th>Nombre Mamá</th>
                        <th>DNI Papá</th>
                        <th>Nombre papá</th>
                        <th>DNI Apoderado</th>
                        <th>Nombre Apoderado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_registro_apoderado" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <h5><b>Datos la madre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input class="form-control" type="text" minlength="8" maxlength="9" id="txt_dni_madre" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_madre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_madre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_madre" style="width:100%">
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_madre" style="width:100%"
                            disabled>
                            <option value="Madre">Madre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_madre">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" value="Chiclayo" type="text" id="txt_ciudad_madre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_madre">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_madre">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_madre"  minlength="9" maxlength="9" onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <hr>
                <h5><b>Datos del padre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input class="form-control" type="text" minlength="8" maxlength="9" id="txt_dni_padre" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_padre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_padre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_padre" style="width:100%">
                            <option value="M">M</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_padre" style="width:100%"
                            disabled>
                            <option value="Papa">Padre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_padre">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_padre" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_padre">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_padre">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_padre" minlength="9" maxlength="9" onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <hr>
                <h5><b>Datos del Apoderado</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input class="form-control" type="text" minlength="8" maxlength="9" id="txt_dni_apoderado" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_apoderado" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_apoderado" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_apoderado" style="width:100%">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_apoderado" style="width:100%">
                            <option value="Abuelo(a)">Abuelo(a)</option>
                            <option value="Tio(a)">Tio(a)</option>
                            <option value="Hermano(a)">Hermano(a)</option>
                            <option value="otro">otro</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control"  max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_apoderado">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_apoderado" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_apoderado">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_apoderado">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_apoderado" minlength="9" maxlength="9" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12" id="div_mensaje_error"><br>
          
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="Registrar_Apoderado()">Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_apoderado" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Apoderado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <h5><b>Datos la madre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idmadre_editar" hidden>
                        <input class="form-control" type="text" id="txt_dni_madre_editar">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_madre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_madre_editar">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_madre_editar" style="width:100%">
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_madre_editar" style="width:100%"
                            disabled>
                            <option value="Madre">Madre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_madre_editar" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" value="Chiclayo" type="text" id="txt_ciudad_madre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_madre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_madre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_madre_editar">
                    </div>
                </div>
                <hr>
                <h5><b>Datos del padre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idpadre_editar" hidden>
                        <input class="form-control" type="text" id="txt_dni_padre_editar">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_padre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_padre_editar">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_padre_editar" style="width:100%">
                            <option value="M">M</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_padre_editar" style="width:100%"
                            disabled>
                            <option value="Papa">Padre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_padre_editar">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_padre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_padre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_padre_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_padre_editar">
                    </div>
                </div>
                <hr>
                <h5><b>Datos del Apoderado</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idapoderado_editar" hidden>
                        <input class="form-control" type="text" id="txt_dni_apoderado_editar">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_apoderado_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_apoderado_editar">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_apoderado_editar" style="width:100%">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_apoderado_editar" style="width:100%">
                            <option value="Abuelo(a)">Abuelo(a)</option>
                            <option value="Tio(a)">Tio(a)</option>
                            <option value="Hermano(a)">Hermano(a)</option>
                            <option value="otro">otro</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" max="2005-12-30" min="1953-12-30" type="date" id="txt_fecha_apoderado_editar">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="ciudad">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_apoderado_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="direccion">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_apoderado_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="correo">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_apoderado_editar">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="telefono">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_apoderado_editar">
                    </div>
                    <div class="col-md-4 mb-3"><br/>
                    <button type="button" class="btn btn-success" id="btnlimpiar">Limpiar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="Modificar_Apoderado()">Modificar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_info_apoderado" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información Apoderado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <h5><b>Datos la madre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idmadre_info" hidden>
                        <input class="form-control" type="text" id="txt_dni_madre_info" disabled>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_madre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_madre_info" disabled>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_madre_info" style="width:100%" disabled>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_madre_info" style="width:100%"
                            disabled>
                            <option value="Madre">Madre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" type="date" id="txt_fecha_madre_info" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" value="Chiclayo" type="text" id="txt_ciudad_madre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_madre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_madre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_madre_info" disabled>
                    </div>
                </div>
                <hr>
                <h5><b>Datos del padre</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idpadre_info" hidden>
                        <input class="form-control" type="text" id="txt_dni_padre_info" disabled>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_padre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_padre_info" disabled>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_padre_info" style="width:100%" disabled>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3" hidden>
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_padre_info" style="width:100%"
                            disabled>
                            <option value="Papa">Padre</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" type="date" id="txt_fecha_padre_info" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_padre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_padre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_padre_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_padre_info" disabled>
                    </div>
                </div>
                <hr>
                <h5><b>Datos del Apoderado</b></h5>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="dni">DNI/CE:</label>
                        <input type="text" id="txt_idapoderado_info" hidden>
                        <input class="form-control" type="text" id="txt_dni_apoderado_info" disabled>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Nacionalidad:</label>
                        <input class="form-control" type="text" value="Peruano" id="txt_nacionalidad_apoderado_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Nombres Completos:</label>
                        <input class="form-control" type="text" id="txt_nombre_apoderado_info" disabled>
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="dni">Genero:</label>
                        <select class="js-example-basic-single mb-2" id="txt_genero_apoderado_info" style="width:100%" disabled>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="">Parentesco</label>
                        <select class="js-example-basic-single mb-2" id="txt_parentesco_apoderado_info" style="width:100%" disabled>
                            <option value="Abuelo(a)">Abuelo(a)</option>
                            <option value="Tio(a)">Tio(a)</option>
                            <option value="Hermano(a)">Hermano(a)</option>
                            <option value="otro">otro</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="dni">Fecha de nacimiento:</label>
                        <input class="form-control" type="date" id="txt_fecha_apoderado_info" disabled>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dni">Ciudad:</label>
                        <input class="form-control" type="text" value="Chiclayo" id="txt_ciudad_apoderado_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Dirección (Domicilio):</label>
                        <input class="form-control" type="text" id="txt_direccion_apoderado_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Correo:</label>
                        <input class="form-control" type="text" id="txt_correo_apoderado_info" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dni">Telefono/Celular:</label>
                        <input class="form-control" type="text" id="txt_telefono_apoderado_info" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
listar_apoderado_serverside();
</script>