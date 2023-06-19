<script src="../js/pago.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="text-right mb-2">
    <form id="reporteForm" method="POST" action="" target="_blank">

        <label for="fecha_inicio">Desde:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>

        <label for="fecha_fin">Hasta:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>

        <label for="formato">Formato:</label>
        <select id="formato" name="formato">
            <option value="">Seleccione formato...</option>
            <option value="PDF">PDF</option>
            <option value="EXCEL">Excel</option>
        </select>&nbsp;

        <button type="submit" class="btn btn-dark btn-sm">Generar Reporte</button>
    </form>

    <script>
    // Obtener referencia al formulario y al elemento select
    const reporteForm = document.getElementById('reporteForm');
    const formatoSelect = document.getElementById('formato');

    // Manejar evento de cambio del select
    formatoSelect.addEventListener('change', function() {
        const selectedOption = this.value;
        if (selectedOption === 'PDF') {
            reporteForm.action = 'fpdf/PruebaV.php';
        } else if (selectedOption === 'EXCEL') {
            reporteForm.action = 'fpdf/excel.php'
        }
    });
    </script>
</div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">LISTA DE PAGOS</h1>
    <button class="btn btn-danger btn-sm float-right" onclick="AbrirModalRegistroPago()"><i class="fas fa-plus"></i>
        Nuevo Pago</button>
</div>

<div class="card-body">
    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
            <div class="col-sm-12">
                <table id="tabla_pago_simple" class="display" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Cod.Matricula</th>
                            <th>Alumno</th>
                            <th>Concepto</th>
                            <th>Mes</th>
                            <th>Fecha</th>
                            <th>Método de Pago</th>
                            <th>Monto</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_registro_pago" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Pagos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Cod de Matrícula</label>
                        <select class="js-example-basic-single" id="select_cod" style="width:100%">
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Monto (S/)</label>
                        <input type="text" id="txt_monto" value="180" class="form-control"
                            onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Descripción</label>
                        <select class="js-example-basic-single mb-2" id="txt_descripcion" style="width:100%">
                            <option value="">Seleccione una opción...</option>
                            <option value="Matricula">Matrícula</option>
                            <option value="Pension">Pensión</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Mes</label>
                        <select class="js-example-basic-single mb-2" id="txt_mes" style="width:100%">
                            <option value="">Seleccione una opción...</option>
                            <option value="Marzo">Marzo</option>
                            <option value="Abril">Abril</option>
                            <option value="Mayo">Mayo</option>
                            <option value="Junio">Junio</option>
                            <option value="Julio">Julio</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Septiembre">Septiembre</option>
                            <option value="Octubre">Octubre</option>
                            <option value="Noviembre">Noviembre</option>
                            <option value="Diciembre">Diciembre</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Modalidad</label>
                        <select class="js-example-basic-single mb-2" id="txt_modalidad" style="width:100%">
                            <option value="">Seleccione una opción...</option>
                            <option value="Efectivo">Efectivo</option>
                            <option value="BCP">BCP</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="">Número de operación (#OP)</label>
                        <input type="text" id="txt_operacion" class="form-control" minlength="8" maxlength="8"
                            onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Fecha de pago</label>
                        <input type="date" id="txt_fecha_pago" class="form-control">
                    </div>
                    <div class="col-12" hidden>
                        <label for="">Fecha de registro</label>
                        <input type="date" id="txt_registro_fecha" value="" class="form-control">
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
                        document.getElementById('txt_registro_fecha').value = fechaFormateada;
                        </script>
                    </div>
                    <div class="col-12">
                        <label for="">Enviar boleta (WhastApp)</label>
                        <input type="text" id="txt_enviar" class="form-control" minlength="9" maxlength="9"
                            onkeypress="return soloNumeros(event)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="Registrar_Pago()">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_pago" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Pagos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Monto (S/)</label>
                        <input type="text" id="txt_idpago_editar" hidden>
                        <input type="number" id="txt_monto_editar" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="">Descripción</label>
                        <select class="js-example-basic-single mb-2" id="txt_descripcion_editar" style="width:100%"
                            disabled>
                            <option value="Matricula">Matrícula</option>
                            <option value="Pension">Pensión</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="Modificar_Pago()">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.select-search').select2();
});
listar_pago_serverside();
cargar_select_cod();
</script>