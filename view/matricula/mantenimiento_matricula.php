<script src="../js/matricula.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LISTA DE MATRÍCULAS</h1>
    <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistroMatricula()"><i
            class="fas fa-plus"></i>
        Nueva Matrícula</button>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="tabla_matricula_simple" class="display" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Cod.Matricula</th>
                        <th>Alumno</th>
                        <th>Apoderado</th>
                        <th>Grado y Sección</th>
                        <th>Situación</th>
                        <th>Procedencia</th>
                        <th>Accion</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_registro_matricula" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Matrícula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">DNI del alumno</label>
                        <select class="js-example-basic-single" id="select_dni" style="width:100%">
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">DNI del apoderado</label>
                        <select class="js-example-basic-single" id="select_dni_apoderado" style="width:100%">
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Nivel-Grado</label>
                        <select class="js-example-basic-single mb-2" id="select_grado" style="width:100%">
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Situación</label>
                        <select class="js-example-basic-single mb-2" id="txt_situacion_matricula" style="width:100%">
                            <option value="">Seleccione una opción</option>
                            <option value="Ingresante">Ingresante</option>
                            <option value="Promovido">Promovido</option>
                            <option value="Repitente">Repitente</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Colegio de procedencia</label>
                        <input type="text" id="txt_procedencia_matricula" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="">Costo Matricula (S/)</label>
                        <input type="text" id="txt_costo_matricula" value="180" minlength="1" maxlength="3"
                            class="form-control" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Costo Mensualidad (S/)</label>
                        <input type="text" id="txt_mensualidad_matricula" value="180" minlength="1" maxlength="3"
                            class="form-control" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Descuento (%)</label>
                        <input type="text" id="txt_descuento_matricula" minlength="1" maxlength="3" value="0"
                            class="form-control" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Fecha Registro</label>
                        <input type="date" id="txt_registro_matricula" value=""
                            class="form-control">
                    </div>
                    <script>
                    // Obtener la fecha actual
                    var fechaActual = new Date();

                    // Formatear la fecha en el formato adecuado para el campo de entrada (YYYY-MM-DD)
                    var mes = fechaActual.getMonth() + 1;
                    var dia = fechaActual.getDate();
                    var año = fechaActual.getFullYear();
                    if (mes < 10) {
                        mes = '0' + mes;
                    }
                    if (dia < 10) {
                        dia = '0' + dia;
                    }
                    var fechaFormateada = año + '-' + mes + '-' + dia;

                    // Establecer la fecha formateada como el valor predeterminado del campo de entrada
                    document.getElementById('txt_registro_matricula').value = fechaFormateada;
                    </script>
                    <div class="col-12">
                        <label for="">Observación:</label>
                        <textarea class="form-control border-1 py-3 px-4" rows="3" id="txt_registro_observacion"
                            maxlength="100"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="Registrar_Matricula()">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_info_matricula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">DETALLE MATRICULA</h5>
            </div>
            <form id="formularioapoderado" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Código Matricula:</b></label>
                            <input class="form-control" type="text" id="txt_codigo_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Alumno(a):</b></label>
                            <input class="form-control" type="text" id="txt_alumno_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Apoderado:</b></label>
                            <input class="form-control" type="text" id="txt_apoderado_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Grado y Sección:</b></label>
                            <input class="form-control" type="text" id="txt_grado_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Situación:</b></label>
                            <input class="form-control" type="text" id="txt_situacion_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Procedencia:</b></label>
                            <input class="form-control" type="text" id="txt_procedencia_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Costo de Matricula: (S/)</b></label>
                            <input class="form-control" type="text" id="txt_costomatri_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Costo de la pensión: (S/)</b></label>
                            <input class="form-control" type="text" id="txt_mensualidad_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Descuento: (%)</b></label>
                            <input class="form-control" type="text" id="txt_descuento_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Fecha de Registro:</b></label>
                            <input class="form-control" type="date" id="txt_fecha_mostrar" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="dni"><b>Deuda total del año escolar:</b></label>
                            <input class="form-control" type="text" id="txt_total_mostrar" disabled>
                        </div>
                        <div class="col-12">
                            <label for="dni"><b>Observación:</b></label>
                            <textarea class="form-control border-1 py-3 px-4" rows="2" id="txt_mostrar_observacion"
                                maxlength="100" disabled></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_historial_matricula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Historial de Pagos</h5>
            </div>
            <form id="formularioapoderado" autocomplete="off">
                <div class="modal-body">
                    <div class="col-12">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="table-active">
                                        <th>CONCEPTO</th>
                                        <th>MES</th>
                                        <th>FECHA</th>
                                        <th>MÉTODO DE PAGO</th>
                                        <th>MONTO</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.select-search').select2();
});
listar_matricula_serverside();
cargar_select_dni();
cargar_select_dni_apoderado();
cargar_select_grado()
</script>