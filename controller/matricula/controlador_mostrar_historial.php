<?php
include_once '../../model/modelo_conexion.php'; // Reemplaza 'ruta_al_archivo_conexionBD.php' con la ruta correcta hacia tu archivo que contiene el modelo de conexión

// Obtén el ID del alumno desde la solicitud POST
$alumnoId = $_POST['id'];

// Crea una instancia de la clase de conexión
$conexionBD = new conexionBD();
$pdo = $conexionBD->conexionPDO();

try {
  // Llama al procedimiento almacenado y obtén los datos del alumno
  $consulta = $pdo->prepare("CALL SP_HISTORIAL_ALUMNO(:alumnoId)");
  $consulta->bindParam(':alumnoId', $alumnoId, PDO::PARAM_INT);
  $consulta->execute();

  // Prepara un array para almacenar los datos del alumno
  $datosAlumno = array();

  // Recorre el resultado del procedimiento almacenado y guarda los datos en el array
  while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $datosAlumno[] = $fila;
  }

  // Devuelve los datos del alumno en formato JSON
  echo json_encode($datosAlumno);
} catch (Exception $e) {
  // Manejar el error si ocurre alguna excepción
  echo 'Error al llamar al procedimiento almacenado: ' . $e->getMessage();
}
?>
