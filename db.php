<?php  
$conn = new mysqli('ballast.proxy.rlwy.net:19685', 'root', 'QbCzqolQCWFyJpCHNeotoFjmAnIwATkR', 'gestiondecarrosmac');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>



