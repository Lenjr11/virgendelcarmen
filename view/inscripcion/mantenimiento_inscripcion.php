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
                        <th>Consulta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
listar_inscripcion_serverside();
</script>