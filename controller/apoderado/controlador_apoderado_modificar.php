<?php
    require '../../model/modelo_apoderado.php';
    $ruta ="";
    $MA = new Modelo_Apoderado();
    $idmadre = htmlspecialchars($_POST['idmadre'],ENT_QUOTES,'UTF-8');
    $nombremadre = htmlspecialchars($_POST['nombremadre'],ENT_QUOTES,'UTF-8');
    $nacimientomadre = htmlspecialchars($_POST['nacimientomadre'],ENT_QUOTES,'UTF-8');
    $ciudadmadre = htmlspecialchars($_POST['ciudadmadre'],ENT_QUOTES,'UTF-8');
    $direccionmadre = htmlspecialchars($_POST['direccionmadre'],ENT_QUOTES,'UTF-8');
    $correomadre = htmlspecialchars($_POST['correomadre'],ENT_QUOTES,'UTF-8');
    $telefonomadre = htmlspecialchars($_POST['telefonomadre'],ENT_QUOTES,'UTF-8');
    //--
    $idpadre = htmlspecialchars($_POST['idpadre'],ENT_QUOTES,'UTF-8');
    $nombrepadre = htmlspecialchars($_POST['nombrepadre'],ENT_QUOTES,'UTF-8');
    $nacimientopadre = htmlspecialchars($_POST['nacimientopadre'],ENT_QUOTES,'UTF-8');
    $ciudadpadre = htmlspecialchars($_POST['ciudadpadre'],ENT_QUOTES,'UTF-8');
    $direccionpadre = htmlspecialchars($_POST['direccionpadre'],ENT_QUOTES,'UTF-8');
    $correopadre = htmlspecialchars($_POST['correopadre'],ENT_QUOTES,'UTF-8');
    $telefonopadre = htmlspecialchars($_POST['telefonopadre'],ENT_QUOTES,'UTF-8');
    //--
    $idapoderado = htmlspecialchars($_POST['idapoderado'],ENT_QUOTES,'UTF-8');
    $dniapoderado = htmlspecialchars($_POST['dniapoderado'],ENT_QUOTES,'UTF-8');
    $nombreapoderado = htmlspecialchars($_POST['nombreapoderado'],ENT_QUOTES,'UTF-8');
    $parentescoapoderado = htmlspecialchars($_POST['parentescoapoderado'],ENT_QUOTES,'UTF-8');
    $nacimientoapoderado = htmlspecialchars($_POST['nacimientoapoderado'],ENT_QUOTES,'UTF-8');
    $ciudadapoderado = htmlspecialchars($_POST['ciudadapoderado'],ENT_QUOTES,'UTF-8');
    $direccionapoderado = htmlspecialchars($_POST['direccionapoderado'],ENT_QUOTES,'UTF-8');
    $correoapoderado = htmlspecialchars($_POST['correoapoderado'],ENT_QUOTES,'UTF-8');
    $telefonoapoderado = htmlspecialchars($_POST['telefonoapoderado'],ENT_QUOTES,'UTF-8');
    $consulta = $MA->Modificar_Apoderado($idmadre,$nombremadre,$nacimientomadre,$ciudadmadre,$direccionmadre,$correomadre,
    $telefonomadre,$idpadre,$nombrepadre,$nacimientopadre,$ciudadpadre,$direccionpadre,$correopadre,$telefonopadre,$idapoderado,$dniapoderado,
    $nombreapoderado,$parentescoapoderado,$nacimientoapoderado,$ciudadapoderado,$direccionapoderado,$correoapoderado,$telefonoapoderado);
    echo $consulta;

?>