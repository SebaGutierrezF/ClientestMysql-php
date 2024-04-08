<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = "8KTAw.sM.BZzsNQ8"; // Cambia esto por tu contraseña de MySQL
$database = "demo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Consulta SQL para seleccionar todos los clientes en orden
$sql = "SELECT * FROM Clientes ORDER BY id_cliente";
$result = $conn->query($sql);

// Array para almacenar los datos de los usuarios
$usuarios = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Almacena los datos de cada usuario en el array
        $usuarios[] = $row;
    }
} else {
    echo "No se encontraron clientes";
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <style>
        .tarjeta {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 300px;
            display: inline-block;
        }
        .flecha {
            cursor: pointer;
            font-size: 24px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <?php
    // Verificar si hay usuarios para mostrar
    if (!empty($usuarios)) {
        // Iterar sobre cada usuario y mostrarlo en una tarjeta
        foreach ($usuarios as $usuario) {
            echo '<div class="tarjeta">';
            echo '<p>ID: ' . $usuario["id_cliente"] . '</p>';
            echo '<p>Rut: ' . $usuario["rut"] . '</p>';
            echo '<p>Nombre: ' . $usuario["nombre"] . ' ' . $usuario["apellido"] . '</p>';
            echo '<p>Dirección: ' . $usuario["direccion"] . '</p>';
            echo '<p>Ciudad: ' . $usuario["ciudad"] . '</p>';
            echo '<p>Teléfono: ' . $usuario["telefono"] . '</p>';
            echo '<p>Email: ' . $usuario["email"] . '</p>';
            echo '</div>';
        }
    } else {
        echo '<p>No hay usuarios para mostrar.</p>';
    }
    ?>

    <!-- Flechas para navegar entre usuarios -->
    <div>
        <span class="flecha" id="anterior">&#10094;</span>
        <span class="flecha" id="siguiente">&#10095;</span>
    </div>

    <script>
        // Variables para controlar la posición del usuario actual
        var usuarioActual = 0;
        var usuarios = <?php echo json_encode($usuarios); ?>;

        // Función para mostrar el usuario actual
        function mostrarUsuario() {
            document.querySelectorAll('.tarjeta').forEach((tarjeta, index) => {
                if (index === usuarioActual) {
                    tarjeta.style.display = 'block';
                } else {
                    tarjeta.style.display = 'none';
                }
            });
        }

        // Evento para la flecha siguiente
        document.getElementById('siguiente').addEventListener('click', function() {
            if (usuarioActual < usuarios.length - 1) {
                usuarioActual++;
                mostrarUsuario();
            }
        });

        // Evento para la flecha anterior
        document.getElementById('anterior').addEventListener('click', function() {
            if (usuarioActual > 0) {
                usuarioActual--;
                mostrarUsuario();
            }
        });

        // Mostrar el primer usuario al cargar la página
        mostrarUsuario();
    </script>
</body>
<style>
    :root {
        color-scheme: light dark;
    }
    body {
        display: grid;
        place-content: center;
    }
    section{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    hgroup{
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
    img{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    div{
        display: flex;
        justify-content: center;
        text-align: center;
    }
    span{
        justify-content: center;
        text-align: center;
        flex-direction: column;
    }
</style>
</html>
