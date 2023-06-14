<?php
require 'serverside.php';
$table_data->getObtnerListadoPago('view_listar_pago','id_pagos',array('id_pagos',
'id_matricula','matric_code','id_alumno','pago_descripcion','pago_fecha',
'pago_modalidad','pago_monto','alumno_nombre','pago_mes'));
 



?>