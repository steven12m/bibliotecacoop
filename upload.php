<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $archivo = $_FILES['archivo'];

    $archivo_nombre = time() . '_' . $archivo['name'];
    $ruta_destino = 'uploads/' . $archivo_nombre;

    if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
        $stmt = $conn->prepare("INSERT INTO circulares (titulo, archivo) VALUES (?, ?)");
        $stmt->bind_param("ss", $titulo, $archivo_nombre);
        $stmt->execute();
        $stmt->close();

        header("Location: index.php");
    } else {
        echo "Error al subir el archivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Circular</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Subir Nueva Circular</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="archivo">Archivo PDF:</label>
            <input type="file" id="archivo" name="archivo" accept=".pdf" required>
            
            <button type="submit">Subir</button>
        </form>
    </div>
</body>
</html>
