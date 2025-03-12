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
    
    // Obtener los datos del vehículo antes de moverlo
    $sql = "SELECT * FROM materiales WHERE id = $id";
    $resultado = $conn->query($sql);
    $vehiculo = $resultado->fetch_assoc();
    
    if ($vehiculo) {
        // Insertar en la tabla de bajas
        $sql_insert = "INSERT INTO bajas (
            n_resguardo, 
            codigo_material, 
            tipo_activo, 
            descripcion, 
            ubicacion, 
            observaciones, 
            foto, 
            fecha_alta,
            fecha_baja
        ) VALUES (
            '{$vehiculo['n_resguardo']}',
            '{$vehiculo['codigo_material']}',
            '{$vehiculo['tipo_activo']}',
            '{$vehiculo['descripcion']}',
            '{$vehiculo['ubicacion']}',
            '{$vehiculo['observaciones']}',
            '{$vehiculo['foto']}',
            '{$vehiculo['fecha_alta']}',
            NOW()
        )";
        
        if ($conn->query($sql_insert) === TRUE) {
            // Eliminar de la tabla materiales
            $sql_delete = "DELETE FROM materiales WHERE id = $id";
            if ($conn->query($sql_delete) === TRUE) {
                header("Location: inventario.php");
                exit();
            }
        }
    }
}

$conn->close();
?>