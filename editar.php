<style>
        /* Estilos CSS integrados directamente */
        /* General styles */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d6dbdf;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        h1, h2, h3 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 300;
        }

        h1.titulo {
            font-size: 2em;
            margin-bottom: 30px;
        }

        .content-wrapper {
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .container-fluid {
            max-width: 1000px;
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 20px;
        }

        .form-left, .form-right {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #2980b9;
            background-color: #fff;
        }

        .textarea-field {
            width: 100%;
            height: 120px;
            resize: none;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #333;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        img.foto {
            max-width: 200px;
            height: auto;
            margin: 10px auto;
            display: block;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        @media (max-width: 768px) {
            .form-wrapper {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            h1.titulo {
                font-size: 1.8em;
            }
        }

        .button-group {

            display: flex;
            justify-content: flex-start;
            gap: 20px;
        }

        .boton {
            display: inline-block;
            background-color: #2980b9;
            padding: 10px 15px;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .boton:hover {
            background-color: #3498db;
        }

        .boton.modificar {
            background-color: #27ae60;
        }

        .boton.modificar:hover {
            background-color: #2ecc71;
        }

        .boton.cancelar {
            background-color: #e74c3c;
        }

        .boton.cancelar:hover {
            background-color: #c0392b;
        }
        .form-left .input-field:last-of-type{
          margin-bottom: 10px;
        }
    </style>
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

// Obtener la foto actual antes de cualquier actualización
$sql_foto = "SELECT foto FROM vehiculos WHERE id = $id";
$result_foto = $conn->query($sql_foto);
$row_foto = $result_foto->fetch_assoc();
$foto_actual = $row_foto['foto'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placa = $_POST['placa'];
    $vin = $_POST['vin'];
    $tipo_vehiculo = $_POST['tipo_vehiculo'];
    $ubicacion = $_POST['ubicacion'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $color = $_POST['color'];
    $kilometraje = $_POST['kilometraje'];
    $descripcion = $_POST['descripcion'];
    $observaciones = $_POST['observaciones'];
    $fecha_compra = $_POST['fecha_compra'];
    $estado_actual= $_POST['estado_actual'];
    
    if(isset($_FILES['nueva_foto']) && $_FILES['nueva_foto']['size'] > 0) {
        $foto = $_FILES['nueva_foto']['name'];
        move_uploaded_file($_FILES['nueva_foto']['tmp_name'], "fotos/" . $foto);
    } else {
        $foto = $foto_actual; // Mantener la foto existente
    }
    
    $sql = "UPDATE vehiculos SET 
            placa ='$placa',
            vin = '$vin',
            tipo_vehiculo = '$tipo_vehiculo',
            ubicacion = '$ubicacion',
            marca = '$marca',
            modelo = '$modelo',
            anio='$anio',
            color='$color',
            kilometraje='$kilometraje',
            descripcion='$descripcion',
            observaciones='$observaciones',
            fecha_compra='$fecha_compra',
            foto = '$foto',
            estado_actual='$estado_actual'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: inventario.php");
        exit();
    }
}

$sql = "SELECT * FROM vehiculos WHERE id = $id";
$resultado = $conn->query($sql);
$item = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Artículo - Inventario Mac</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_adminP1.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3>Editar Artículo</h3>
            </div>
            <div class="form-wrapper">
                <div class="form-left">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">placa</label>
                        <input type="text" class="form-control" name="placa" value="<?php echo $item['placa']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">vin(numero de serie)</label>
                        <input type="text" class="form-control" name="vin" value="<?php echo $item['vin']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de vehiculo</label>
                        <select class="form-select" name="tipo_vehiculo" required>
                        <?php echo $item['tipo_vehiculo']; ?>
                            <option value="sedan" <?php echo ($item['tipo_vehiculo'] == 'Sedan') ? 'selected' : ''; ?>>Sedan</option>
                            <option value="SUV" <?php echo ($item['tipo_vehiculo'] == 'SUV') ? 'selected' : ''; ?>>SUV</option>
                            <option value="Pickup" <?php echo ($item['tipo_vehiculo'] == 'Pickup') ? 'selected' : ''; ?>>Pickup</option>
                            <option value="Van" <?php echo ($item['tipo_vehiculo'] == 'Van') ? 'selected' : ''; ?>>Van</option>
                            <option value="Camion" <?php echo ($item['tipo_vehiculo'] == 'Camion') ? 'selected' : ''; ?>>Camion</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" required><?php echo $item['descripcion']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <select class="form-select" name="ubicacion" required>
                        <?php echo $item['ubicacion']; ?>
                            <option value="cuernavaca" <?php echo ($item['ubicacion'] == 'cuernavaca') ? 'selected' : ''; ?>>Cuernavaca</option>
                            <option value="CDMX" <?php echo ($item['ubicacion'] == 'CDMX') ? 'selected' : ''; ?>>CDMX</option>
                            <option value="Puebla" <?php echo ($item['ubicacion'] == 'Puesbla') ? 'selected' : ''; ?>>Puebla</option>
                            <option value="Tijuana" <?php echo ($item['ubicacion'] == 'Tijuana') ? 'selected' : ''; ?>>Tijuana</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones" style="white-space: pre-wrap;"><?php echo htmlspecialchars($item['observaciones']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Actual</label>
                        <img src="fotos/<?php echo $item['foto']; ?>" width="200" class="d-block mb-2">
                        <label class="form-label">Cambiar Foto (opcional)</label>
                        <input type="file" class="form-control" name="nueva_foto">
                    </div>
                    
                
                
            </div>
            <div class="form-right">
                    <div class="mb-3">
                        <label class="form-label">fecha_alta</label>
                        <input type="text" class="form-control" name="fecha_alta" value="<?php echo $item['fecha_alta']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">marca</label>
                        <input type="text" class="form-control" name="marca" value="<?php echo $item['marca']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">modelo</label>
                        <input type="text" class="form-control" name="modelo" value="<?php echo $item['modelo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">anio</label>
                        <input type="text" class="form-control" name="anio" value="<?php echo $item['anio']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">color</label>
                        <input type="text" class="form-control" name="color" value="<?php echo $item['color']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">kilometraje</label>
                        <input type="text" class="form-control" name="kilometraje" value="<?php echo $item['kilometraje']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">fecha_compra</label>
                        <input type="text" class="form-control" name="fecha_compra" value="<?php echo $item['fecha_compra']; ?>" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">estado actual</label>
                        <select class="form-select" name="estado_actual" required>
                            <?php echo $item['estado_actual']; ?>
                            <option value="activo" <?php echo ($item['estado_actual'] == 'activo') ? 'selected' : ''; ?>>activo</option>
                            <option value="en reparación" <?php echo ($item['estado_actual'] == 'en reparacion') ? 'selected' : ''; ?>>en reparación</option>
                            <option value="dado de baja" <?php echo ($item['estado_actual'] == 'dado de baja') ? 'selected' : ''; ?>>dado de baja</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="inventario.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                    </form>
            </div>
            
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>