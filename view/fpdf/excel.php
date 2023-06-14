<?php

include_once '../../model/modelo_conexion.php';
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Reporte_Pagos.xls");
?>


<table class="table table-striped table-dark " id= "table_id">

                   
<thead>    
<tr>
<th>N</th>
<th>Cod. Matricula</th>
<th>Alumno</th>
<th>Concepto</th>
<th>Mes</th>
<th>Fecha</th>
<th>M. Pago</th>
<th>Monto</th>


</tr>
</thead>
<tbody>

<?php

$conexion = new conexionBD();
$pdo = $conexion->conexionPDO();

$sql = "select 
matricula.matric_code,
alumno.alumno_nombre,
pagos.pago_descripcion,
pagos.pago_mes,
pagos.pago_fecha,
pagos.pago_modalidad,
pagos.pago_monto
from pagos
inner join matricula on pagos.id_matricula=matricula.id_matricula
inner join alumno on matricula.id_alumno=alumno.id_alumno";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
   $i = $i + 1;
   $columna1 = $fila['matric_code'];
   $columna2 = $fila['alumno_nombre'];
   $columna3 = $fila['pago_descripcion'];
   $columna4 = $fila['pago_mes'];
   $columna5 = $fila['pago_fecha'];
   $columna6 = $fila['pago_modalidad'];
   $columna7 = $fila['pago_monto'];
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $columna1; ?></td>
<td><?php echo $columna2; ?></td>
<td><?php echo $columna3; ?></td>
<td><?php echo $columna4; ?></td>
<td><?php echo $columna5; ?></td>
<td><?php echo $columna6; ?></td>
<td><?php echo $columna7; ?></td>



<?php
}
