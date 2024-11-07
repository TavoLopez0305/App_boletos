<?php
// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_boletos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Consulta para obtener todas las carreras
$sql = "SELECT id, nombre FROM carreras";
$result = mysqli_query($conn, $sql);

// Crear un array para almacenar los resultados
$carreras = array();
while ($row = mysqli_fetch_assoc($result)) {
    $carreras[] = $row;
}

// Convertir el array a JSON y enviarlo
header('Content-Type: application/json');
echo json_encode($carreras);
// Convertir el array a JSON y guardarlo en un archivo
$json_data = json_encode($carreras);
file_put_contents('carreras.json', $json_data);
