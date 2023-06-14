<?php
    require '../../model/modelo_matricula.php';
    $ruta ="";
    $MU = new Modelo_Matricula();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Matricula_Estatus($id,$estado);
    echo $consulta;

?>