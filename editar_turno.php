<?php
include 'conexion.php';
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$conn->query("UPDATE turnos SET nombre='$nombre', fecha='$fecha', hora='$hora' WHERE id=$id");
$conn->close();
header("Location: index.php");
?>
