<?php  
/* $servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "gestiondecarrosmac";
$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    die("Error en la conexión con el servidor: " . mysqli_connect_error());
}
else {
    echo "Conexión exitosa hola hola
    ";
} */
$conn = new mysqli('localhost', 'root', '', 'gestiondecarrosmac');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>



