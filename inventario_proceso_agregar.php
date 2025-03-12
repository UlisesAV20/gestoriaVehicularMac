<?php
$host = "ballast.proxy.rlwy.net:19685";
$user = "root";
$pass = "QbCzqolQCWFyJpCHNeotoFjmAnIwATkR";
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar y obtener los datos del formulario
    $placa = $conn->real_escape_string($_POST['placa']);
    $vin = $conn->real_escape_string($_POST['vin']);
    $tipo_vehiculo = $conn->real_escape_string($_POST['tipo_vehiculo']);
    $ubicacion = $conn->real_escape_string($_POST['ubicacion']);
    $marca = $conn->real_escape_string($_POST['marca']);
    $modelo = $conn->real_escape_string($_POST['modelo']);
    $anio = intval($_POST['anio']);
    $color = $conn->real_escape_string($_POST['color']);
    $kilometraje = floatval($_POST['kilometraje']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $observaciones = $conn->real_escape_string($_POST['observaciones']);
    $fecha_compra = $_POST['fecha_compra'];

    // Procesar la foto
    $foto = "";
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto_nombre = time() . '_' . $_FILES['foto']['name'];
        $foto_destino = 'fotos/' . $foto_nombre;
        
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $foto_destino)) {
            $foto = $foto_nombre;
        }
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO vehiculos (
        placa, 
        vin, 
        tipo_vehiculo,
        ubicacion, 
        marca,
        modelo,
        anio,
        color,
        kilometraje,
        descripcion,
        observaciones,
        fecha_compra,
        foto,
        fecha_alta,
        estado_actual
    ) VALUES (
        '$placa',
        '$vin',
        '$tipo_vehiculo',
        '$ubicacion',
        '$marca',
        '$modelo',
        $anio,
        '$color',
        $kilometraje,
        '$descripcion',
        '$observaciones',
        '$fecha_compra',
        '$foto',
        NOW(),
        'Activo'
    )";

    if ($conn->query($sql) === TRUE) {
        header("Location: inventario.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
