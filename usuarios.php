<?php
// Conexión a la base de datos
$host = "ballast.proxy.rlwy.net:19685";
$user = "root";
$pass = "QbCzqolQCWFyJpCHNeotoFjmAnIwATkR";  // Cambia esto si tienes contraseña
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuarios Mac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Usuarios Registrados</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM user";
                            $resultado = $conn->query($sql);
                            $contador = 1;

                            if ($resultado->num_rows > 0) {
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$contador}</td>";
                                    echo "<td>{$fila['usuario']}</td>";
                                    echo "<td>{$fila['nombre']}</td>";
                                    echo "<td>{$fila['puesto']}</td>";
                                    echo "<td>{$fila['password']}</td>";
                                    echo "<td class='text-center'>
                                            <a href='editar_usuario.php?id={$fila['id']}' class='btn btn-warning btn-sm me-2'><i class='fas fa-edit'></i> Editar</a>
                                            <a href='eliminar_usuario.php?id={$fila['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\")'><i class='fas fa-trash'></i> Eliminar</a>
                                          </td>";
                                    echo "</tr>";
                                    $contador++;
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No hay usuarios registrados</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="agregar_usuario.php" class="btn btn-success"><i class="fas fa-user-plus"></i> Agregar Usuario</a>
                    <a href="inventario.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>