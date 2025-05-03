<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$sql = "INSERT INTO turnos (nombre, fecha, hora) VALUES ('$nombre', '$fecha', '$hora')";
$conn->query($sql);
$conn->close();

header("Location: index.php");
?>
