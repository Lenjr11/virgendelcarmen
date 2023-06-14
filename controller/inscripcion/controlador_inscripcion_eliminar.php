<?php
    require '../../model/modelo_inscripcion.php';
    $ruta ="";
    $MU = new Modelo_Inscripcion();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');

    $consulta = $MU->Eliminar_Inscripcion($id);
    echo $consulta;

?>