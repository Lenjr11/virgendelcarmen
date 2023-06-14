<?php
    require '../../model/modelo_alumno.php';
    $MA = new Modelo_Alumno();
    $contador=0;
    $error="";
    $dni = htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');
    $nacionalidad = htmlspecialchars($_POST['nacionalidad'],ENT_QUOTES,'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES,'UTF-8');
    $genero = htmlspecialchars($_POST['genero'],ENT_QUOTES,'UTF-8');
    $nacimiento = htmlspecialchars($_POST['nacimiento'],ENT_QUOTES,'UTF-8');
    $celular = htmlspecialchars($_POST['celular'],ENT_QUOTES,'UTF-8');
    $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES,'UTF-8');
    $direccion = htmlspecialchars($_POST['direccion'],ENT_QUOTES,'UTF-8');
    //para solo letras
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nacionalidad)) {
        $contador++;
        $error.="El campo NACIONALIDAD solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombre)) {
        $contador++;
        $error.="El campo NOMBRES solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$ciudad)) {
        $contador++;
        $error.="El campo CIUDAD solo debe contener letras.<br>";
    }
    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$dni)) {
        $contador++;
        $error.="El campo DNI solo debe contener números.<br>";
    }
    if (!preg_match("/^[[:digit:]\s]*$/",$celular)) {
        $contador++;
        $error.="El campo CELULAR solo debe contener números.<br>";
    }
    if($contador>0){
        echo $error;
    }else{
        $consulta = $MA->Registrar_Alumno($dni,$nacionalidad,$nombre,$genero,$nacimiento,$celular,$ciudad,$direccion);
        echo $consulta;
    }


?>