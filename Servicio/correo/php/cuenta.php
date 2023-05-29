<?php
// Establecer la conexión con la base de datos
$host = 'localhost';
$db = 'email_service';
$user = 'root';
$password = '';

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Error al conectar con la base de datos: " . $e->getMessage();
}

// Obtener el ID del empleado desde la cookie "id_empleado"
$id_empleado = $_COOKIE['id_empleado'];

// Obtener los datos del formulario
$nombre_usuario = $_POST['username'];
$cuenta_correo = $_POST['account'];
$contrasena = $_POST['password'];
$confirmar_contrasena = $_POST['pass_confirm'];

// Obtener el password actual del registro de la tabla "empleado" con el ID correspondiente
$query_password = "SELECT pass FROM empleado WHERE id_empleado = :id_empleado";
$stmt_password = $conn->prepare($query_password);
$stmt_password->bindParam(':id_empleado', $id_empleado);
$stmt_password->execute();
$registro = $stmt_password->fetch(PDO::FETCH_ASSOC);
$password_actual = $registro['pass'];


if ($contrasena === $confirmar_contrasena) {
  // Actualizar el registro del empleado en la tabla "empleado"
  $query = "UPDATE empleado SET nickname = :nombre_usuario, cuenta = :cuenta_correo, pass = :contrasena WHERE id_empleado = :id_empleado";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':nombre_usuario', $nombre_usuario);
  $stmt->bindParam(':cuenta_correo', $cuenta_correo);
  $stmt->bindParam(':contrasena', $contrasena);
  $stmt->bindParam(':id_empleado', $id_empleado);

  if ($contrasena !== $password_actual) {
    // Obtener el ID del remitente y destinatario desde la cookie "id_empleado"
    $id_remitente = $_COOKIE['id_empleado'];
    $id_destinatario = $_COOKIE['id_empleado'];

    // Obtener el registro de empleado con nickname igual a "jwu"
    $query2 = "SELECT * FROM empleado WHERE id_empleado = :id_empleado AND nickname = 'jwu'";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':id_empleado', $id_empleado);
    $stmt2->execute();
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($row) {
    // Si se encontró un empleado con el nickname "jwu", generar el contenido como una bandera tipo CTF
    $contenido = "Felicidades! la bandera es hackercitos{4956722e537e28b111a8fc82a1843a0765ebe682df833a5cbe7ae2f5e3e0441b}";
    } else {
    // Si no se encontró un empleado con el nickname "jwu", establecer un contenido diferente
    $contenido = "Contraseña cambiada con exito";
    }

    // Obtener la fecha actual
    $fecha_envio = date('Y-m-d H:i:s');

    // Realizar la inserción en la tabla "correo"
    $query2 = "INSERT INTO correo (id_remitente, id_destinatario, asunto, contenido, fecha_envio) VALUES (:id_remitente, :id_destinatario, 'Cambio de contraseña', :contenido, :fecha_envio)";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':id_remitente', $id_remitente);
    $stmt2->bindParam(':id_destinatario', $id_destinatario);
    $stmt2->bindParam(':contenido', $contenido);
    $stmt2->bindParam(':fecha_envio', $fecha_envio);
    $stmt2->execute();
  }

  $stmt->execute();

  echo '<script>alert("Datos de usuario actualizados correctamente");</script>';
  header('Location: ../correo.html');
} else {
  echo '<script>alert("Contraseña no coincide");</script>';
  header('Location: ../correo.html');
}

// Cerrar la conexión
$conn = null;
?>

