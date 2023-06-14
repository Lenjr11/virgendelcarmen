<?php
require 'serverside.php';
$table_data->getObtnerListadoAlumno('view_listar_alumno','id_alumno',array('id_alumno',
'alumno_dni','alumno_nacionalidad','alumno_nombre','alumno_genero','alumno_fecha_nacimiento','alumno_ciudad','alumno_direccion','alumno_estado','alumno_celular'));
 



?>