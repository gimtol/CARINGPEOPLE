<?php
session_start();

if (isset($_POST['btningresar'])) {
    // Conectar con la base de datos
    $conn = new mysqli("localhost", "root", "", "mi_base_de_datos");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    // Consultar si el usuario existe
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($pass, $row['password'])) {
            $_SESSION['usuario'] = $usuario;  // Iniciar la sesión
            header("Location: editar_usuario.html");  // Redirigir a la página de edición
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $conn->close();
}
?>
