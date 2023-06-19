<?php
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

// Imprimir el número actual
echo  "B003 - ".$numeroFormateado;

// Guardar el nuevo número en el archivo
file_put_contents($archivo, $numero);

?>