<?php
require 'serverside.php';
$table_data->getObtnerListadoUsuario('view_listar_usuario','id_usuario',array('id_usuario',
'usuari_nombre','usuari_usuario','usuari_clave','id_rol','rol_descripcion','usuari_estado','usuari_correo','usuari_apellidos','usuari_telefono'));
 



?>