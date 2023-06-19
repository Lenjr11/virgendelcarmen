<?php
require 'serverside.php';
$table_data->getObtnerListadoMatricula('view_listar_matricula','id_matricula',array('id_matricula',
'id_alumno','alumno_nombre','matric_apoder','matric_code','id_grado','grado_nombre','matric_situacion','matric_procedencia',
'matric_costo','matric_mensualidad','matric_descuento','matric_fecha','matric_estado','matric_total','grado_seccion','matric_observacion'));
 



?>