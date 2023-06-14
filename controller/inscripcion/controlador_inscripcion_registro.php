<?php
    require '../../model/modelo_inscripcion.php';
    $MA = new Modelo_Inscripcion();
    $dni = htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8');
    $nombres = htmlspecialchars($_POST['nombres'],ENT_QUOTES,'UTF-8');
    $apellidos = htmlspecialchars($_POST['apellidos'],ENT_QUOTES,'UTF-8');
    $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES,'UTF-8');
    $telefono = htmlspecialchars($_POST['telefono'],ENT_QUOTES,'UTF-8');
    $grado = htmlspecialchars($_POST['grado'],ENT_QUOTES,'UTF-8');
    $consulta = htmlspecialchars($_POST['consulta'],ENT_QUOTES,'UTF-8');

    $consulta = $MA->Registrar_inscripcion($dni,$nombres,$apellidos,$correo,$telefono,$grado,$consulta);

    $fields = ['phone' => '951274739', 'message' => "ccccccccc"];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000/message/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=$telefono&message=Hemos recibido tu registro, pronto nos comunicaremos con usted!" );
    $data = curl_exec($ch);
    curl_close($ch);

    echo $consulta;

?>