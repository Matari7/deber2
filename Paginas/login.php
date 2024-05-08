<?php
// Conexión a la base de datos
$servername = "mysql-matari.alwaysdata.net";
$username = "matari_test";
$password = "UniversidadCentral123*";
$database = "matari_distribuida2";

// Create connection

$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Función para limpiar y validar datos
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Manejar el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = clean_input($_POST["username"]);
    $password = clean_input($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Inicio de sesión exitoso";
            // Aquí puedes redirigir al usuario a otra página después del inicio de sesión exitoso
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
    $conn->close();
}
?>
