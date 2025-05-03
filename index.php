<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Amorcitas Lashes</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Amorcitas Lashes 💕</h1>

  <h2>Reservar Turno</h2>
  <form action="guardar_turno.php" method="post">
    <label>Fecha:</label>
    <input type="date" name="fecha" id="fecha" required>
    <label>Hora:</label>
    <select name="hora" id="hora" required></select>
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <input type="submit" value="Reservar">
  </form>

  <h2>Turnos Reservados</h2>
  <table border="1">
    <tr><th>Nombre</th><th>Fecha</th><th>Hora</th><th>Acciones</th></tr>
    <?php
    include 'conexion.php';
    $conn->query("DELETE FROM turnos WHERE fecha < CURDATE() - INTERVAL 7 DAY");
    $result = $conn->query("SELECT * FROM turnos ORDER BY fecha, hora");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
          <form action='editar_turno.php' method='post'>
          <td><input type='text' name='nombre' value='{$row['nombre']}'></td>
          <td><input type='date' name='fecha' value='{$row['fecha']}'></td>
          <td><input type='time' name='hora' value='{$row['hora']}'></td>
          <td>
            <input type='hidden' name='id' value='{$row['id']}'>
            <input type='submit' value='Editar'>
            <a href='eliminar_turno.php?id={$row['id']}'>Eliminar</a>
          </td>
          </form>
        </tr>";
    }
    ?>
  </table>

  <script>
document.getElementById('fecha').addEventListener('change', function() {
  fetch('horarios_disponibles.php?fecha=' + this.value)
    .then(response => response.json())
    .then(data => {
      const select = document.getElementById('hora');
      select.innerHTML = '';
      if (data.length === 0) {
        const option = document.createElement('option');
        option.text = "No hay horarios disponibles";
        select.add(option);
      } else {
        data.forEach(hora => {
          const option = document.createElement('option');
          option.value = hora;
          option.text = hora;
          select.add(option);
        });
      }
    });
});
  </script>
</body>
</html>
