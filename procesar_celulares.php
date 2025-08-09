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
$directorioDestino = "uploads/";
if (!file_exists($directorioDestino)) {
    mkdir($directorioDestino, 0777, true); // Crea el directorio si no existe
}


function guardarImagen($nombreCampo) {
    $directorioDestino = "uploads/";
    $nombreArchivo = basename($_FILES[$nombreCampo]["name"]);
    $rutaCompleta = $directorioDestino . $nombreArchivo;
    if (move_uploaded_file($_FILES[$nombreCampo]["tmp_name"], $rutaCompleta)) {
        echo "Imagen guardada correctamente en: " . $rutaCompleta;
        return $rutaCompleta;
    } else {
        
        return null;
    }
}


// Verificar si se ha enviado una solicitud POST para reparación de celulares
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_celulares'])) {
    // Obtener los datos del formulario de reparación de celulares
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $descripcion = $_POST['descripcion'];

    // Guardar las imágenes en el servidor
    $foto1 = guardarImagen('foto1');
    $foto2 = guardarImagen('foto2');
    $foto3 = guardarImagen('foto3');
    $foto4 = guardarImagen('foto4');

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO citas_celulares (nombre, apellido, celular, email, descripcion, foto1, foto2, foto3, foto4)
            VALUES ('$nombre', '$apellido', '$celular', '$email', '$descripcion', '$foto1', '$foto2', '$foto3', '$foto4')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Cotizacion de reparación de celulares agendada correctamente en brebe recibira un mensaje de cotizacion";
        echo "<script>
        setTimeout(function() {
            window.location.href = 'index.html'; // Redirigir a la página de inicio
        }, 5000); // 5000 milisegundos = 5 segundos
      </script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para guardar una imagen en el servidor y devolver la ruta


// Cerrar conexión
$conn->close();
?>

