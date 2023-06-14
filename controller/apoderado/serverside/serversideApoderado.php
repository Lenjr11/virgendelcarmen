<?php
require 'serverside.php';
$table_data->getObtnerListadoApoderado('view_listar_apoderado','id_madre',array('id_madre',
'madre_dni','madre_nombre','madre_ciudad','madre_direccion','madre_correo','madre_telcel','madre_estado',
'id_padre','padre_dni','padre_nombre','padre_ciudad','padre_direccion','padre_correo','padre_telcel',
'id_apoderado','apoder_dni','apoder_nombre','apoder_ciudad','apoder_direccion','apoder_correo','apoder_telcel',
'madre_nacionalidad','madre_genero','madre_fecha','padre_nacionalidad','padre_genero','padre_fecha',
'apoder_nacionalidad','apoder_genero','apoder_parentesco','apoder_fecha'));
 



?>