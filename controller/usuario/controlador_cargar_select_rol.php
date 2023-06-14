<?php
    require '../../model/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $consulta = $MU->listar_select_rol();
    echo json_encode($consulta);

?>