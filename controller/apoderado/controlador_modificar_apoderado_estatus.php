<?php
    require '../../model/modelo_apoderado.php';
    $ruta ="";
    $MU = new Modelo_Apoderado();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Apoderado_Estatus($id,$estado);
    echo $consulta;

?>