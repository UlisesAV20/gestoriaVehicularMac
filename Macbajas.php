<?php
$host = "ballast.proxy.rlwy.net:19685";
$user = "root";
$pass = "QbCzqolQCWFyJpCHNeotoFjmAnIwATkR";
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    
<style>
        .animated-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .animated-button:hover {
            transform: translateX(-5px);
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }

        .animated-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: width 0.3s ease, height 0.3s ease, margin 0.3s ease;
        }

        .animated-button:active::after {
            width: 200px;
            height: 200px;
            margin-left: -100px;
            margin-top: -100px;
            opacity: 0;
        }
    </style>

    <meta charset="UTF-8">
    <title>Vehículos dados de Baja - Mac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3>Vehículos dados de Baja</h3>
                <a href="inventario.php" class="btn btn-primary animated-button">
                    <i class="fas fa-arrow-left"></i> Volver al Inventario
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" >
                        <thead class="thead-dark font-weight-bold">
                            <tr>
                                <th>#</th>
                                <th>Número de Resguardo</th>
                                <th>Número de Inventario</th>
                                <th>Tipo de Activo</th>
                                <th>Descripción</th>
                                <th>Ubicación</th>
                                <th>Observaciones</th>
                                <th>Foto</th>
                                <th>Fecha de Alta</th>
                                <th>Fecha de Baja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM bajas ORDER BY fecha_baja DESC";
                            $resultado = $conn->query($sql);
                            $contador = 1;

                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$contador}</td>";
                                    echo "<td>{$fila['n_resguardo']}</td>";
                                    echo "<td>{$fila['codigo_material']}</td>";
                                    echo "<td>{$fila['tipo_activo']}</td>";
                                    echo "<td>{$fila['descripcion']}</td>";
                                    echo "<td>{$fila['ubicacion']}</td>";
                                    echo "<td>{$fila['observaciones']}</td>";
                                    echo "<td><img src='fotos/{$fila['foto']}' width='100'></td>";
                                    echo "<td>{$fila['fecha_alta']}</td>";
                                    echo "<td>{$fila['fecha_baja']}</td>";
                                    echo "</tr>";
                                    $contador++;
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center'>No hay vehículos dados de baja</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>