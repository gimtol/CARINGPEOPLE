<?php
$servername = "localhost"; // Cambia esto si tu servidor es diferente
$username = "tu_usuario";   // Reemplaza con tu nombre de usuario
$password = "tu_contraseña"; // Reemplaza con tu contraseña
$dbname = "mi_base_de_datos"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
echo "Conexión exitosa";

// Aquí puedes realizar tus consultas a la base de datos

// Cerrar conexión
$conn->close();
?>

