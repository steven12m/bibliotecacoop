<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT archivo FROM circulares WHERE id = $id");
$circular = $result->fetch_assoc();

unlink('uploads/' . $circular['archivo']); // Eliminar archivo físico

$conn->query("DELETE FROM circulares WHERE id = $id");

header("Location: index.php");
?>
