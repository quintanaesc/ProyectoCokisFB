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

// Obtener el ID del remitente desde la cookie "id_empleado"
$id_remitente = $_COOKIE['id_empleado'];

// Obtener el ID del destinatario a partir del correo proporcionado en el formulario
$destinatario = $_POST['destinatario'];
$query = "SELECT id_empleado FROM empleado WHERE cuenta = :destinatario";
$stmt = $conn->prepare($query);
$stmt->bindParam(':destinatario', $destinatario);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  // Si se encontró un destinatario válido, obtener los demás datos del formulario
  $id_destinatario = $row['id_empleado'];
  $asunto = $_POST['asunto'];
  $contenido = $_POST['contenido'];
  $fecha_envio = date('Y-m-d H:i:s'); // Fecha y hora actual

  // Realizar la inserción en la tabla "correo"
  $query = "INSERT INTO correo (id_remitente, id_destinatario, asunto, contenido, fecha_envio) VALUES (:id_remitente, :id_destinatario, :asunto, :contenido, :fecha_envio)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id_remitente', $id_remitente);
  $stmt->bindParam(':id_destinatario', $id_destinatario);
  $stmt->bindParam(':asunto', $asunto);
  $stmt->bindParam(':contenido', $contenido);
  $stmt->bindParam(':fecha_envio', $fecha_envio);
  $stmt->execute();

  echo '<script>alert("Correo enviado correctamente");</script>';
} else {
  echo '<script>alert("Correo enviado correctamente");</script>';;
}
header('Location: ../correo.html');

// Cerrar la conexión
$conn = null;
?>

