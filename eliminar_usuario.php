<?php
session_start();

if (isset($_POST['btneliminar'])) {
    // Conectar con la base de datos
    $conn = new mysqli("localhost", "root", "", "mi_base_de_datos");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $usuario = $_SESSION['usuario'];

    // Eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE usuario='$usuario'";

    if ($conn->query($sql) === TRUE) {
        session_destroy();  // Destruir la sesión
        echo "Cuenta eliminada correctamente.";
        header("Location: login.html");  // Redirigir al login
    } else {
        echo "Error al eliminar la cuenta: " . $conn->error;
    }

    $conn->close();
}
?>
