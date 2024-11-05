<?php
// Conexión a la base de datos (reemplaza con tus datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_boletos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}


// Procesar datos del formulario si se ha enviado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y limpiarlos
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];

    // Consulta preparada para mayor seguridad
    $sql = "SELECT * FROM usuarios WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Redirigir a subir_info.html
            header("Location: subir_info.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

    $stmt->close();
} else {
    echo "Error al enviar";
}

$conn->close();
?>

