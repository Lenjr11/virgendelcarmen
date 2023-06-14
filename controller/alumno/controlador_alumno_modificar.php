<?php
    require '../../model/modelo_alumno.php';
    $ruta ="";
    $MA = new Modelo_Alumno();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    $consulta = $MA->Modificar_Alumno($id,$nombre,$ciudad,$direccion);
    echo $consulta;

?>