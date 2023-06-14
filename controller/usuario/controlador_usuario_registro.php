<?php
    require '../../model/modelo_usuario.php';
    $MU = new Modelo_Usuario();
    $contador=0;
    $error="";
    $nombre = htmlspecialchars($_POST['n'],ENT_QUOTES,'UTF-8');
    $apellido = htmlspecialchars($_POST['a'],ENT_QUOTES,'UTF-8');
    $usuario = htmlspecialchars($_POST['u'],ENT_QUOTES,'UTF-8');
    $email = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
    $contra = password_hash($_POST['c'],PASSWORD_DEFAULT,['cost'=>12]);
    $telefono = htmlspecialchars($_POST['t'],ENT_QUOTES,'UTF-8');
    $fecha = htmlspecialchars($_POST['f'],ENT_QUOTES,'UTF-8');
    $rol = htmlspecialchars($_POST['r'],ENT_QUOTES,'UTF-8');
    //para solo letras
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$nombre)) {
        $contador++;
        $error.="El campo NOMBRES solo debe contener letras.<br>";
    }
    if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/",$apellido)) {
        $contador++;
        $error.="El campo APELLIDOS solo debe contener letras.<br>";
    }

    //Para solo números
    if (!preg_match("/^[[:digit:]\s]*$/",$telefono)) {
        $contador++;
        $error.="El campo TEL/CEL solo debe contener números.<br>";
    }
    if($contador>0){
        echo $error;
    }else{
        $consulta = $MU->Registrar_Usuario($nombre,$apellido,$usuario,$email,$contra,$telefono,$fecha,$rol);
        echo $consulta;
    }
    

?>