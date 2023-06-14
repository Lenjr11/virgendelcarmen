<?php
    require '../../model/modelo_pago.php';
    $MU = new Modelo_Pago();
    $consulta = $MU->listar_select_cod();
    echo json_encode($consulta);

?>