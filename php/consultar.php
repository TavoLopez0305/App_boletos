<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_boletos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $matricula = $_GET['matricula'];

    // Consulta a la base de datos
    $sql = "SELECT * FROM alumnos WHERE matricula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matricula);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Obtener el nombre de la carrera
        $sql_carrera = "SELECT nombre FROM carreras WHERE id = ?";
        $stmt_carrera = $conn->prepare($sql_carrera);
        $stmt_carrera->bind_param("i", $row['carrera_id']);
        $stmt_carrera->execute();
        $result_carrera = $stmt_carrera->get_result();
        $row_carrera = $result_carrera->fetch_assoc();

        // Mostrar los resultados en formato JSON para que JavaScript pueda manipularlos fácilmente
        echo json_encode([
            'nombre' => $row['nombre'],
            'carrera' => $row_carrera['nombre']
        ]);
    } else {
        echo "Estudiante no encontrado";
    }
}

$conn->close();
?>