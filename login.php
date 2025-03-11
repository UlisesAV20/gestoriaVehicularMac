<?php
session_start();
include 'db.php'; // Conexión a la BD

$usuario = $_POST['clave'];
$contraseña = $_POST['pass'];

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta segura (prepared statement)
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = ? AND contraseña = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param('ss', $usuario, $contraseña);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;  // Guarda sesión
    header('Location: inventario.php');
    exit();
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.html';</script>";
}

$stmt->close();
$conn->close();
?>
