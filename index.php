<?php
include 'db.php';

$result = $conn->query("SELECT * FROM circulares ORDER BY fecha_subida DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circulares Vigentes</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Circulares Vigentes</h1>
        <a href="upload.php" class="btn">Subir Nueva Circular</a>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['titulo']; ?></td>
                        <td><a href="uploads/<?php echo $row['archivo']; ?>" target="_blank">Ver PDF</a></td>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn">Cambiar</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
