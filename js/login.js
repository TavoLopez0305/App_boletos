document.getElementById("login-form").onsubmit = function(event) {
    event.preventDefault();

    // Obtener los valores ingresados
    const username = document.querySelector('.user').value;
    const password = document.querySelector('.password').value;

    // Verificar si los campos están vacíos
    if (username === "" || password === "") {
        alert("Por favor, ingresa tu nombre de usuario y contraseña.");
        return; // Detener la ejecución si falta algún campo
    }

    // Validar si el usuario y contraseña coinciden con el administrador
    if (username === "Tavo" && password === "Kkdecat:3") {
        // Redirigir al documento `subir_info.html` si la validación es exitosa
        window.location.href = "subir_info.html";
    } else {
        // Mostrar un mensaje de error si la validación falla
        alert("Usuario o contraseña incorrectos");
    }
};
