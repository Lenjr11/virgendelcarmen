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
    $registro = htmlspecialchars($_POST['registro'],ENT_QUOTES,'UTF-8');
    $enviar = htmlspecialchars($_POST['enviar'],ENT_QUOTES,'UTF-8');
    $archivo = 'numero.txt';
    // Verificar si el archivo existe
    if (file_exists($archivo)) {
        // Leer el número almacenado en el archivo
        $numero = intval(file_get_contents($archivo));
    } else {
        // Si el archivo no existe, comenzar desde el número 1
        $numero = 1;
    }
    
    // Incrementar el número para la próxima vez
    $numero++;
    
    // Convertir el número a una cadena de 4 dígitos, rellenando con ceros a la izquierda si es necesario
    $numeroFormateado = str_pad($numero, 4, '0', STR_PAD_LEFT);
    
    
    
    // Guardar el nuevo número en el archivo
    file_put_contents($archivo, $numero);

    $boleta = "B003 - ".$numeroFormateado;

    $consulta = $MA->Registrar_Pago($code,$monto,$descripcion,$mes,$fecha,$modalidad,$operacion,$registro,$enviar,$boleta);


    $fields = ['phone' => '951274739', 'message' => "ccccccccc"];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:3000/message/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "phone=$enviar&message=Su comprobante del mes de $mes se registró correctamente en el colegio!" );
    $data = curl_exec($ch);
    curl_close($ch);

    echo $consulta;

?>