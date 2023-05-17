<?php
// Verificar si la coki existe
if (isset($_COOKIE['id_empleado'])) {

    // Obtiene el valor de la cookie
    $idEmpleado = $_COOKIE['id_empleado'];

    // Establecer la conexión con la base de datos
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

    // Escapa el valor del ID empleado para prevenir inyección de SQL
    $idEmpleado = $pdo->quote($idEmpleado);

    // Realiza la consulta en la tabla "empleados"
    $sql = "SELECT nickname FROM empleado WHERE id_empleado = $idEmpleado";
    $result = $pdo->query($sql);

    // Verifica si se encontró un resultado
    if ($result->rowCount() > 0) {
        // Obtiene el nombre de usuario del primer resultado
        $row = $result->fetch();
        $username = $row['nickname'];

        // Muestra el nombre de usuario
        echo '<li>'. $username .'</li>';
    } else {
        echo "No se encontró ningún empleado";
    }

    // Cierra la conexión a la base de datos
    $pdo = null;
} else {
    echo "La cookie no existe.";
}
?>