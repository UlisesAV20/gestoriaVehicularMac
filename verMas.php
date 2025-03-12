<?php
$host = "ballast.proxy.rlwy.net:19685";
$user = "root";
$pass = "QbCzqolQCWFyJpCHNeotoFjmAnIwATkR";
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
$sql = "SELECT * FROM vehiculos WHERE id = $id";
$resultado = $conn->query($sql);
$vehiculo = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Vehículo - Mac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">
    <style>
        .detail-card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .vehicle-image {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .detail-value {
            color: #333;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="card detail-card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h3>Detalles del Vehículo</h3>
                <a href="inventario.php" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Volver al Inventario
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="fotos/<?php echo $vehiculo['foto']; ?>" class="vehicle-image mb-4" alt="Foto del vehículo">
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p class="detail-label">Placa:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['placa']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Número de Serie (VIN):</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['vin']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Tipo de Vehículo:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['tipo_vehiculo']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Marca:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['marca']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Modelo:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['modelo']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Año:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['anio']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Color:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['color']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Ubicación:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['ubicacion']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Fecha de Alta:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['fecha_alta']); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Estatus:</p>
                            <p class="detail-value"><?php echo htmlspecialchars($vehiculo['estado_actual']); ?></p>
                        </div>
                        
                    </div>
                    <div class="mb-3">
                            <p class="detail-label">Descripción:</p>
                            <p class="detail-value"><?php echo nl2br(htmlspecialchars($vehiculo['descripcion'])); ?></p>
                        </div>
                        <div class="mb-3">
                            <p class="detail-label">Observaciones:</p>
                            <p class="detail-value"><?php echo nl2br(htmlspecialchars($vehiculo['observaciones'])); ?></p>
                        </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>