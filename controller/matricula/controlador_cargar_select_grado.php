<?php
    require '../../model/modelo_matricula.php';
    $MU = new Modelo_Matricula();
    $consulta = $MU->listar_select_grado();
    echo json_encode($consulta);

?>