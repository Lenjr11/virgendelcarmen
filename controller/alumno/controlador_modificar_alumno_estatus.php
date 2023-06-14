<?php
    require '../../model/modelo_alumno.php';
    $ruta ="";
    $MU = new Modelo_Alumno();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Alumno_Estatus($id,$estado);
    echo $consulta;

?>