<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario de MySQL es diferente
$password = ""; // Cambia esto si tu contraseña de MySQL es diferente
$dbname = "Proyecto"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Encriptar contraseña
    $phone = $_POST['phone']; // Asegúrate de que este campo exista en tu formulario

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usuario, $pass, $email, $phone);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
}
$conn->close();
?>
