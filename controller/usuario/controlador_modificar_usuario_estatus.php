<?php
    require '../../model/modelo_usuario.php';
    $ruta ="";
    $MU = new Modelo_Usuario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Modificar_Usuario_Estatus($id,$estado);
    echo $consulta;

?>