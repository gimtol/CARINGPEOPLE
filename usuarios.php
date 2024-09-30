<?php
include 'conexion.php'; // Conexión a la base de datos

// Consulta para obtener todos los usuarios
$sql = "SELECT * FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nombre']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td>
                <!-- Enlaces para editar y eliminar -->
                <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                <a href="eliminar.php?id=<?php echo $usuario['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
