<?php
include 'conexion.php';

$fecha = $_GET['fecha'];

// Detectar si es jueves (número 4, porque la semana empieza en lunes = 1)
$dia = date('N', strtotime($fecha));

// Horarios normales
$horarios = [
  '08:00', '11:00'
];

// Si es jueves (4), agregamos más horarios
if ($dia == 4) {
  $horarios = array_merge($horarios, ['14:00', '17:00']);
}

$result = $conn->query("SELECT hora FROM turnos WHERE fecha = '$fecha'");
$ocupados = [];

while ($row = $result->fetch_assoc()) {
  $ocupados[] = $row['hora'];
}

$disponibles = array_diff($horarios, $ocupados);
echo json_encode(array_values($disponibles));
?>
