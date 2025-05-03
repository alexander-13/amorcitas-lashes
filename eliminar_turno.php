<?php
include 'conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM turnos WHERE id=$id");
$conn->close();
header("Location: index.php");
?>
