<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM circulares WHERE id = $id");
$circular = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $archivo = $_FILES['archivo'];
    $archivo_nombre = $circular['archivo'];

    if ($archivo['name']) {
        $archivo_nombre = time() . '_' . $archivo['name'];
        move_uploaded_file($archivo['tmp_name'], 'uploads/' . $archivo_nombre);
    }

    $stmt = $conn->prepare("UPDATE circulares SET titulo = ?, archivo = ? WHERE id = ?");
    $stmt->bind_param("ssi", $titulo, $archivo_nombre, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Circular</title>
</head>
<body>
    <h1>Actualizar Circular</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $circular['titulo']; ?>" required><br>
        <label for="archivo">Archivo PDF:</label>
        <input type="file" id="archivo" name="archivo" accept=".pdf"><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
