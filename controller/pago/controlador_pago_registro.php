<?php
    require '../../model/modelo_pago.php';
    $MA = new Modelo_Pago();
    $code = htmlspecialchars($_POST['code'],ENT_QUOTES,'UTF-8');
    $monto = htmlspecialchars($_POST['monto'],ENT_QUOTES,'UTF-8');
    $descripcion = htmlspecialchars($_POST['descripcion'],ENT_QUOTES,'UTF-8');
    $mes = htmlspecialchars($_POST['mes'],ENT_QUOTES,'UTF-8');
    $fecha = htmlspecialchars($_POST['fecha'],ENT_QUOTES,'UTF-8');
    $modalidad = htmlspecialchars($_POST['modalidad'],ENT_QUOTES,'UTF-8');
    $operacion = htmlspecialchars($_POST['operacion'],ENT_QUOTES,'UTF-8');

    $consulta = $MA->Registrar_Pago($code,$monto,$descripcion,$mes,$fecha,$modalidad,$operacion);


    $fields = ['phone' => '951274739', 'message' => "ccccccccc"];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000/message/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=955537473&message=Su comprobante del mes de $mes se registró correctamente en el colegio!" );
    $data = curl_exec($ch);
    curl_close($ch);

    echo $consulta;

?>