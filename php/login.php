<?php
include("conexion.php");

// Procesar datos del formulario solo si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y validar
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    // Validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit();
    }

    // Consultar en la base de datos si el usuario existe y la contraseña es correcta
    $consulta = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        echo "Inicio de sesión exitoso.";
        // Aquí puedes redirigir a una página de bienvenida o dashboard
        header("Location: ../pages/subir_info.html");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
} else {
    // Si el formulario no se ha enviado, muestra el formulario de inicio de sesión
    echo "
        <form method='POST' action=''>
            <label for='username'>Usuario:</label>
            <input type='text' name='username' id='username' required>
            
            <label for='password'>Contraseña:</label>
            <input type='password' name='password' id='password' required>
            
            <button type='submit'>Iniciar sesión</button>
        </form>
    ";
}

mysqli_close($conexion);
?>
