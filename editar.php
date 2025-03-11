<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gestiondecarrosmac";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n_resguardo = $_POST['n_resguardo'];
    $codigo_material = $_POST['codigo_material'];
    $tipo_activo = $_POST['tipo_activo'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $observaciones = $_POST['observaciones'];
    
    if(isset($_FILES['nueva_foto']) && $_FILES['nueva_foto']['size'] > 0) {
        $foto = $_FILES['nueva_foto']['name'];
        move_uploaded_file($_FILES['nueva_foto']['tmp_name'], "fotos/" . $foto);
        
        $sql = "UPDATE materiales SET 
                n_resguardo = '$n_resguardo',
                codigo_material = '$codigo_material',
                tipo_activo = '$tipo_activo',
                descripcion = '$descripcion',
                ubicacion = '$ubicacion',
                observaciones = '$observaciones',
                foto = '$foto'
                WHERE id = $id";
    } else {
        $sql = "UPDATE materiales SET 
                n_resguardo = '$n_resguardo',
                codigo_material = '$codigo_material',
                tipo_activo = '$tipo_activo',
                descripcion = '$descripcion',
                ubicacion = '$ubicacion',
                observaciones = '$observaciones'
                WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: inventario.php");
        exit();
    }
}

$sql = "SELECT * FROM materiales WHERE id = $id";
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
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Número de Resguardo</label>
                        <input type="text" class="form-control" name="n_resguardo" value="<?php echo $item['n_resguardo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Número de Inventario</label>
                        <input type="text" class="form-control" name="codigo_material" value="<?php echo $item['codigo_material']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo de Activo</label>
                        <input type="text" class="form-control" name="tipo_activo" value="<?php echo $item['tipo_activo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" required><?php echo $item['descripcion']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ubicación</label>
                        <select class="form-select" name="ubicacion" required>
                            <option value="">Seleccionar ubicación</option>
                            <option value="Almacen" <?php echo ($item['ubicacion'] == 'Almacen') ? 'selected' : ''; ?>>Cuernavaca</option>
                            <option value="Direccion" <?php echo ($item['ubicacion'] == 'Direccion') ? 'selected' : ''; ?>>CDMX</option>
                            <option value="Secretaria Academica (Direccion)" <?php echo ($item['ubicacion'] == 'Secretaria Academica (Direccion)') ? 'selected' : ''; ?>>Puebla</option>
                            <option value="Secretaria de Investigacion (Direccion)" <?php echo ($item['ubicacion'] == 'Secretaria de Investigacion (Direccion)') ? 'selected' : ''; ?>>Tijuana</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observaciones</label>
                        <textarea class="form-control" name="observaciones"><?php echo $item['observaciones']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Actual</label>
                        <img src="fotos/<?php echo $item['foto']; ?>" width="200" class="d-block mb-2">
                        <label class="form-label">Cambiar Foto (opcional)</label>
                        <input type="file" class="form-control" name="nueva_foto">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="inventario.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>