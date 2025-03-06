<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";  // Cambia esto si tienes contraseña
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$n_resguardo = $_POST['n_resguardo'];
$codigo_material = $_POST['codigo_material'];
$tipo_activo = $_POST['Tactivo'];
$descripcion = $_POST['descripcion'];
$ubicacion = $_POST['Ubicacion1'];
$observaciones = $_POST['ubicacion'];
$fecha_alta = $_POST['fecha_alta'];

// Manejar foto (subir archivo)
$foto = "";
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $nombreFoto = time() . "_" . basename($_FILES['foto']['name']);
    $rutaDestino = "fotos/" . $nombreFoto;  // se guardan las fotos de los automoviles en la carpeta fotos

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
        $foto = $nombreFoto;  // Guardar solo el nombre para la BD
    } else {
        $foto = "";  // Si hay error, se guarda vacío
    }
}

// Guardar en la base de datos
$sql = "INSERT INTO materiales (n_resguardo, codigo_material, tipo_activo, descripcion, ubicacion, observaciones, foto, fecha_alta) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $n_resguardo, $codigo_material, $tipo_activo, $descripcion, $ubicacion, $observaciones, $foto, $fecha_alta);

if ($stmt->execute()) {
    header("Location: inventario.php?mensaje=exito");
} else {
    echo "Error al guardar: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
