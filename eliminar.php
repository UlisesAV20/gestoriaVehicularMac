<?php
$host = "ballast.proxy.rlwy.net:19685";
$user = "root";
$pass = "QbCzqolQCWFyJpCHNeotoFjmAnIwATkR";
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Primero obtenemos la información de la foto para eliminarla
    $sql = "SELECT foto FROM vehiculos WHERE id = $id";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $foto = $fila['foto'];
        
        // Eliminamos la foto del servidor si existe
        if ($foto && file_exists("fotos/" . $foto)) {
            unlink("fotos/" . $foto);
        }
        
        // Eliminamos el registro de la base de datos
        $sql = "DELETE FROM vehiculos WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            header("Location: inventario.php");
            exit();
        } else {
            echo "Error al eliminar el vehículo: " . $conn->error;
        }
    } else {
        echo "No se encontró el vehículo especificado.";
    }
} else {
    header("Location: inventario.php");
    exit();
}

$conn->close();
?>