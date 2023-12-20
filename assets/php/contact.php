<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$fechaHora = date("Y-m-d H:i:s");

$conexion = new mysqli("localhost", "tutiRacoon2017", "Agustuti1997", "formulario_contacto");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $conexion->real_escape_string($nombre);
$email = $conexion->real_escape_string($email);
$mensaje = $conexion->real_escape_string($mensaje);

$sql = "INSERT INTO tu_tabla (nombre, email, mensaje, fecha_hora) VALUES ('$nombre', '$email', '$mensaje', '$fechaHora')";
$resultado = $conexion->query($sql);

if ($resultado) {
    // Envía el correo electrónico
    $destinatario = "nadin@somosmagna.com";
    $asunto = "Nuevo formulario en somosmagna";
    $cuerpoMensaje = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje\nFecha y Hora: $fechaHora";
    $headers = "From: tu_direccion_de_email@example.com";

    // Envía el correo electrónico
    mail($destinatario, $asunto, $cuerpoMensaje, $headers);

    echo "Los datos se han insertado correctamente y se ha enviado un correo electrónico.";
} else {
    echo "Error al insertar datos: " . $conexion->error;
}

$conexion->close();
?>

