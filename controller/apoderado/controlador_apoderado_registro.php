<?php
    require '../../model/modelo_apoderado.php';
    $MA = new Modelo_Apoderado();
    $contador=0;
    $error="";
    $dnimadre = htmlspecialchars($_POST['dnimadre'],ENT_QUOTES,'UTF-8');
    $nacionalidadmadre = htmlspecialchars($_POST['nacionalidadmadre'],ENT_QUOTES,'UTF-8');
    $nombremadre = htmlspecialchars($_POST['nombremadre'],ENT_QUOTES,'UTF-8');
    $generomadre = htmlspecialchars($_POST['generomadre'],ENT_QUOTES,'UTF-8');
    $parentescomadre = htmlspecialchars($_POST['parentescomadre'],ENT_QUOTES,'UTF-8');
    $nacimientomadre = htmlspecialchars($_POST['nacimientomadre'],ENT_QUOTES,'UTF-8');
    $ciudadmadre = htmlspecialchars($_POST['ciudadmadre'],ENT_QUOTES,'UTF-8');
    $direccionmadre = htmlspecialchars($_POST['direccionmadre'],ENT_QUOTES,'UTF-8');
    $correomadre = htmlspecialchars($_POST['correomadre'],ENT_QUOTES,'UTF-8');
    $telefonomadre = htmlspecialchars($_POST['telefonomadre'],ENT_QUOTES,'UTF-8');
    //-------------------------------------------
    $dnipadre = htmlspecialchars($_POST['dnipadre'],ENT_QUOTES,'UTF-8');
    $nacionalidadpadre = htmlspecialchars($_POST['nacionalidadpadre'],ENT_QUOTES,'UTF-8');
    $nombrepadre = htmlspecialchars($_POST['nombrepadre'],ENT_QUOTES,'UTF-8');
    $generopadre = htmlspecialchars($_POST['generopadre'],ENT_QUOTES,'UTF-8');
    $parentescopadre = htmlspecialchars($_POST['parentescopadre'],ENT_QUOTES,'UTF-8');
    $nacimientopadre = htmlspecialchars($_POST['nacimientopadre'],ENT_QUOTES,'UTF-8');
    $ciudadpadre = htmlspecialchars($_POST['ciudadpadre'],ENT_QUOTES,'UTF-8');
    $direccionpadre = htmlspecialchars($_POST['direccionpadre'],ENT_QUOTES,'UTF-8');
    $correopadre = htmlspecialchars($_POST['correopadre'],ENT_QUOTES,'UTF-8');
    $telefonopadre = htmlspecialchars($_POST['telefonopadre'],ENT_QUOTES,'UTF-8');
    //----------------------
    $dniapoderado = htmlspecialchars($_POST['dniapoderado'],ENT_QUOTES,'UTF-8');
    $nacionalidadapoderado = htmlspecialchars($_POST['nacionalidadapoderado'],ENT_QUOTES,'UTF-8');
    $nombreapoderado = htmlspecialchars($_POST['nombreapoderado'],ENT_QUOTES,'UTF-8');
    $generoapoderado = htmlspecialchars($_POST['generoapoderado'],ENT_QUOTES,'UTF-8');
    $parentescoapoderado = htmlspecialchars($_POST['parentescoapoderado'],ENT_QUOTES,'UTF-8');
    $nacimientoapoderado = htmlspecialchars($_POST['nacimientoapoderado'],ENT_QUOTES,'UTF-8');
    $ciudadapoderado = htmlspecialchars($_POST['ciudadapoderado'],ENT_QUOTES,'UTF-8');
    $direccionapoderado = htmlspecialchars($_POST['direccionapoderado'],ENT_QUOTES,'UTF-8');
    $correoapoderado = htmlspecialchars($_POST['correoapoderado'],ENT_QUOTES,'UTF-8');
    $telefonoapoderado = htmlspecialchars($_POST['telefonoapoderado'],ENT_QUOTES,'UTF-8');
    //para solo letras
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nacionalidadmadre)) {
        $contador++;
        $error.="El campo NACIONALIDAD en la sección MADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombremadre)) {
        $contador++;
        $error.="El campo NOMBRE en la sección MADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$ciudadmadre)) {
        $contador++;
        $error.="El campo CIUDAD en la sección MADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nacionalidadpadre)) {
        $contador++;
        $error.="El campo NACIONALIDAD en la sección PADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombrepadre)) {
        $contador++;
        $error.="El campo NOMBRE en la sección PADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$ciudadpadre)) {
        $contador++;
        $error.="El campo CIUDAD en la sección PADRE solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nacionalidadapoderado)) {
        $contador++;
        $error.="El campo NACIONALIDAD en la sección APODERADO solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombreapoderado)) {
        $contador++;
        $error.="El campo NOMBRE en la sección APODERADO solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$ciudadapoderado)) {
        $contador++;
        $error.="El campo CIUDAD en la sección APODERADO solo debe contener letras.<br>";
    }
    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$dnimadre)) {
        $contador++;
        $error.="El campo DNI en la sección MADRE solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$telefonomadre)) {
        $contador++;
        $error.="El campo TELÉFONO en la sección MADRE solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$dnipadre)) {
        $contador++;
        $error.="El campo DNI en la sección PADRE solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$telefonopadre)) {
        $contador++;
        $error.="El campo TELÉFONO en la sección PADRE solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$dniapoderado)) {
        $contador++;
        $error.="El campo DNI en la sección APODERADO solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$telefonoapoderado)) {
        $contador++;
        $error.="El campo TELÉFONO en la sección APODERADO solo debe contener números.<br>";
    }
    if($contador>0){
        echo $error;
    }else{
        $consulta = $MA->Registrar_Apoderado($dnimadre,$nacionalidadmadre,$nombremadre,$generomadre,$parentescomadre,$nacimientomadre,$ciudadmadre,$direccionmadre,$correomadre,$telefonomadre,
        $dnipadre,$nacionalidadpadre,$nombrepadre,$generopadre,$parentescopadre,$nacimientopadre,$ciudadpadre,$direccionpadre,$correopadre,$telefonopadre,
        $dniapoderado,$nacionalidadapoderado,$nombreapoderado,$generoapoderado,$parentescoapoderado,$nacimientoapoderado,$ciudadapoderado,$direccionapoderado,$correoapoderado,$telefonoapoderado);
        echo $consulta;
    }


?>