<script src="../js/inscripcion.js?rev=<?php echo time(); ?>"></script>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">SOLICITUDES PARA MATRÍCULAS</h1>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12 table-responsive">
            <table id="tabla_inscripcion_simple" class="display" width="100%">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>DNI del Alumno</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo (Padre-Apoderado)</th>
                        <th>Teléfono</th>
                        <th>Grado interés</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="modal_consulta_padre" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Mostrar Consulta</h5>
            </div>
            <form id="formularioapoderado" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="dni"><b>Consulta:</b></label>
                            <textarea class="form-control border-0 py-3 px-4" rows="5" id="txt_consulta_mostrar" disabled></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
listar_inscripcion_serverside();
</script>