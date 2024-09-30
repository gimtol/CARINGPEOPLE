<?php
include 'conexion.php'; // Conexión a la base de datos

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    // Actualizar los datos en la base de datos
    $sql = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        echo "Usuario actualizado con éxito";
        header("Location: usuarios.php"); // Redireccionar de vuelta a la lista de usuarios
        exit;
    } else {
        echo "Error al actualizar el usuario";
    }
} else {
    // Obtener el ID del usuario a editar
    $id = $_GET['id'];
    
    // Obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="editar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required><br>
        <label for="email">Correo:</label>
        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
    <br>
    <a href="usuarios.php">Volver a la lista de usuarios</a>
</body>
</html>
