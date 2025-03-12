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
    <style>
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: none;
        }
        
        .card-header {
            border-radius: 10px 10px 0 0 !important;
            background: linear-gradient(45deg, #1a1e21, #343a40) !important;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
            border-color: #454d55;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        .btn {
            border-radius: 5px;
            padding: 0.375rem 0.75rem;
            transition: all 0.3s ease;
        }

        .btn-warning {
            color: white;
            background-color: #ffc107;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-success:hover {
            background-color: #218838;
        }
        body {
            background: linear-gradient(135deg, #1a1e21 0%, #343a40 100%);
            min-height: 100vh;
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            border: none;
            background: white;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            background: linear-gradient(45deg, #1a1e21, #343a40) !important;
            padding: 1.5rem;
        }

        .card-header h3 {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .table {
            margin-bottom: 0;
            font-size: 0.95rem;
        }

        .table thead th {
            background: linear-gradient(45deg, #343a40, #495057);
            color: white;
            border-color: #454d55;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            transform: scale(1.01);
        }

        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .btn i {
            margin-right: 5px;
        }

        .btn-warning {
            color: white;
            background: linear-gradient(45deg, #ffc107, #ffad00);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(45deg, #ffad00, #ff9500);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #c82333);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #bd2130);
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(45deg, #28a745, #218838);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(45deg, #218838, #1e7e34);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            border: none;
        }

        .btn-secondary:hover {
            background: linear-gradient(45deg, #5a6268, #4e555b);
            transform: translateY(-2px);
        }
        .table thead th {
            background-color: #0d6efd;  /* Changed from #343a40 to Bootstrap blue */
            color: white;
            border-color: #0a58ca;  /* Adjusted border color to match */
        }
        .table thead th {
            background: linear-gradient(45deg, #0d6efd, #0a58ca);  /* Changed from #343a40, #495057 to blue gradient */
            color: white;
            border-color: #0a58ca;
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        .btn-outline-light {
            color: #ffffff;
            border: 2px solid #ffffff;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            border-color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-outline-danger {
            color: #ffffff;
            border: 2px solid #dc3545;
            background: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ffffff;
            border-color: #dc3545;
            transform: translateY(-2px);
        }
        body {
        background: #f8f9fa;  /* Light gray background instead of dark */
        min-height: 100vh;
    }
    
    /* Update card styles for better contrast */
    .card {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        background: white;
    }
        


    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuarios Mac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">
</head>

<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Cierre de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="inventario.php" class="nav-link"><i class="fas fa-home"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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