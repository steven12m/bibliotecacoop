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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Subir Nueva Circular</h1>
        <form action="" method="post" enctype="multipart/form-data" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" id="titulo" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="archivo" class="form-label">Archivo PDF:</label>
                <input type="file" id="archivo" name="archivo" class="form-control" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Subir</button>
        </form>
    </div>
</body>
</html>
