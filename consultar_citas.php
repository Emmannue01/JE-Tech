
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Citas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "id22048793_je";
$password = "Char1101#";
$dbname = "id22048793_techje";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para buscar citas en ambas tablas
$sql = "SELECT 'Celular' AS tipo, nombre, celular, email, descripcion, foto1, foto2, foto3, foto4, NULL AS servicio
        FROM citas_celulares
        UNION ALL
        SELECT 'Computadora' AS tipo, nombre, celular, email, NULL AS descripcion, NULL AS foto1, NULL AS foto2, NULL AS foto3, NULL AS foto4, servicio
        FROM citas_computadoras";

// Ejecutar la consulta
$result = $conn->query($sql);

// Mostrar los resultados
if ($result->num_rows > 0) {
    echo "<h2>Todas las Citas</h2>";
    echo "<table>";
    echo "<tr><th>Tipo</th><th>Nombre</th><th>Celular</th><th>Email</th><th>Descripción</th><th>Fotos</th><th>Servicio</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["tipo"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["celular"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["descripcion"] . "</td>";
        echo "<td>";
        if ($row["tipo"] == "Celular") {
            echo "<img src='" . $row["foto1"] . "' alt='Foto 1'>";
            echo "<img src='" . $row["foto2"] . "' alt='Foto 2'>";
            echo "<img src='" . $row["foto3"] . "' alt='Foto 3'>";
            echo "<img src='" . $row["foto4"] . "' alt='Foto 4'>";
        } else {
            echo "N/A";
        }
        echo "</td>";
        echo "<td>" . $row["servicio"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron citas.";
}

// Cerrar conexión
$conn->close();
?>

</body>
</html>

