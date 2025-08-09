
<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "GG";
$password = "GG";
$dbname = "GG";


// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha enviado una solicitud POST para mantenimiento de computadoras
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_computadoras'])) {
    // Obtener los datos del formulario de mantenimiento de computadoras
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $servicio = $_POST['servicio'];
    $descripcion = $_POST['descripcion'];

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO citas_computadoras (nombre, apellido, celular, email, servicio, descripcion)
            VALUES ('$nombre', '$apellido', '$celular', '$email', '$servicio', '$descripcion')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Cita de mantenimiento de computadoras hecha correctamente espere en brebe nos contactaremos";
        echo "<script>
        setTimeout(function() {
            window.location.href = 'index.html'; // Redirigir a la página de inicio
        }, 5000); // 5000 milisegundos = 5 segundos
      </script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

