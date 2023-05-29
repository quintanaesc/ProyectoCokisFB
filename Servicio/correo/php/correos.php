<?php
$host = 'localhost';
$db = 'email_service';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '<script>alert("Conexión fallida");</script>';
    die();
}

// Obtener el ID del empleado de la cookie
$id_empleado = $_COOKIE['id_empleado'];

// Consulta SQL para obtener los correos del destinatario específico
$query = 'SELECT c.id_correo, e.cuenta AS remitente, c.asunto, c.contenido, c.fecha_envio
          FROM correo AS c
          INNER JOIN empleado AS e ON c.id_remitente = e.id_empleado
          WHERE c.id_destinatario = :id_destinatario
          ORDER BY c.fecha_envio DESC';
$statement = $pdo->prepare($query);
$statement->bindParam(':id_destinatario', $id_empleado);
$statement->execute();
$correos = $statement->fetchAll(PDO::FETCH_ASSOC);
if (!empty($correos)) {
    $respuesta = array('correos' => $correos);
    echo json_encode($respuesta);
} else {
    echo json_encode(array('correos' => []));
}
?>