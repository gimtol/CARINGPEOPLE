<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header('login.php');  // Redirige al login si no ha iniciado sesión
    exit();
}

// Conectar con la base de datos
$conn = new mysqli("localhost", "root", "", "mi_base_de_datos");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener información actual del usuario desde la base de datos
$usuario = $_SESSION['usuario'];
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email_actual = $row['email']; // Suponiendo que tienes un campo email
}

// Actualizar información del usuario
if (isset($_POST['btneditar'])) {
    $nuevo_usuario = $_POST['usuario'];
    $nuevo_email = $_POST['email'];
    $nueva_password = $_POST['password'];

    // Solo actualizar la contraseña si se ingresa una nueva
    if (!empty($nueva_password)) {
        $hash_password = password_hash($nueva_password, PASSWORD_BCRYPT);
        $sql_update = "UPDATE usuarios SET usuario='$nuevo_usuario', email='$nuevo_email', password='$hash_password' WHERE usuario='$usuario'";
    } else {
        $sql_update = "UPDATE usuarios SET usuario='$nuevo_usuario', email='$nuevo_email' WHERE usuario='$usuario'";
    }

    if ($conn->query($sql_update) === TRUE) {
        // Actualizar la sesión con el nuevo nombre de usuario
        $_SESSION['usuario'] = $nuevo_usuario;
        echo "Información actualizada con éxito.";
    } else {
        echo "Error al actualizar la información: " . $conn->error;
    }
}

// Eliminar cuenta del usuario
if (isset($_POST['btneliminar'])) {
    $sql_delete = "DELETE FROM usuarios WHERE usuario='$usuario'";

    if ($conn->query($sql_delete) === TRUE) {
        session_destroy();  // Destruir la sesión
        header('login.php');  // Redirigir al login después de eliminar la cuenta
        exit();
    } else {
        echo "Error al eliminar la cuenta: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Información del Usuario</title>
    <link rel="stylesheet" href="editar_usuario.php">
</head>
<body>
    <h2>Editar o Eliminar Información</h2>
    
    <form action="editar_usuario.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario']; ?>" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $email_actual; ?>" required>
        
        <label for="password">Nueva Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Deja en blanco si no deseas cambiar">
        
        <input type="submit" value="Guardar Cambios" name="btneditar">
    </form>

    <form action="editar_usuario.php" method="POST">
        <h3>¿Deseas eliminar tu cuenta?</h3>
        <button type="submit" name="btneliminar">Eliminar Cuenta</button>
    </form>
</body>
</html>
