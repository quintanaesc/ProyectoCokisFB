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

if ($contrasena === $confirmar_contrasena) {
  // Actualizar el registro del empleado en la tabla "empleado"
  $query = "UPDATE empleado SET nickname = :nombre_usuario, cuenta = :cuenta_correo, pass = :contrasena WHERE id_empleado = :id_empleado";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':nombre_usuario', $nombre_usuario);
  $stmt->bindParam(':cuenta_correo', $cuenta_correo);
  $stmt->bindParam(':contrasena', $contrasena);
  $stmt->bindParam(':id_empleado', $id_empleado);
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

