<?php
    
	include_once '../../model/modelo_conexion.php';

    $alumnoId = $_POST['id'];
    $intento = $_POST['intento']; 

	$conexion = new conexionBD();
	$pdo = $conexion->conexionPDO();

    $consulta = $pdo->prepare("
    UPDATE usuario set
    usuari_intento=$intento
    where id_usuario=$alumnoId");

	$consulta->execute();

?>