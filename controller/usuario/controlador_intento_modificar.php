<?php
    require '../../model/modelo_usuario.php';
    $ruta ="";
    $MU = new Modelo_Usuario();
    $user = htmlspecialchars($_POST['user'],ENT_QUOTES,'UTF-8');
    $consulta = $MU->Modificar_Intento_Usuario($user);
    echo $consulta;

?>