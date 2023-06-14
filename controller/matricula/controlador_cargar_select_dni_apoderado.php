<?php
    require '../../model/modelo_matricula.php';
    $MU = new Modelo_Matricula();
    $consulta = $MU->listar_select_dni_apoderado();
    echo json_encode($consulta);

?>