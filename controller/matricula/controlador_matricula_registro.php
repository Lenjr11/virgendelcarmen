<?php
    require '../../model/modelo_matricula.php';
    $MA = new Modelo_Matricula();
    $contador=0;
    $error="";
    $dni = htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');
    $dniapoderado = htmlspecialchars($_POST['dniapoderado'],ENT_QUOTES,'UTF-8');
    $caracteres_permitidos = '0123456789';
    $longitud = 10;
    $matricode = substr(str_shuffle($caracteres_permitidos), 0, $longitud);
    $grado = htmlspecialchars($_POST['grado'],ENT_QUOTES,'UTF-8');
    $situacion = htmlspecialchars($_POST['situacion'],ENT_QUOTES,'UTF-8');
    $procedencia = htmlspecialchars($_POST['procedencia'],ENT_QUOTES,'UTF-8');
    $cmatricula = htmlspecialchars($_POST['cmatricula'],ENT_QUOTES,'UTF-8');
    $cmensualidad = htmlspecialchars($_POST['cmensualidad'],ENT_QUOTES,'UTF-8');
    $descuento = htmlspecialchars($_POST['descuento'],ENT_QUOTES,'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'],ENT_QUOTES,'UTF-8');
    $matrictotal = ($cmensualidad-($cmensualidad*$descuento/100))*10;

    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$cmatricula)) {
        $contador++;
        $error.="El campo COSTO MATRÍCULA solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$cmensualidad)) {
        $contador++;
        $error.="El campo COSTO MENSUALIDAD solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$descuento)) {
        $contador++;
        $error.="El campo DESCUENTO solo debe contener números.<br>";
    }
    if($contador>0){
        echo $error;
    }else{
        $consulta = $MA->Registrar_Matricula($dni,$dniapoderado,$matricode,$grado,$situacion,$procedencia,$cmatricula,$cmensualidad,$descuento,$fecha,$matrictotal);
        echo $consulta;
    }
    

?>