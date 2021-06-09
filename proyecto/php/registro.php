<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/style1.css">
    <script src="../js/animacion.js"></script>
    <script src="../js/validar.js"></script>
</head>
<body onload="animacion()">
    <div id="conte">
        <i class="bi bi-person-plus-fill"></i>
        <h1>Registrarse</h1>
        <form action="iniciar.php" method="post" onsubmit="return validar(this);">
            <input type="text" name="nombre" class="input" id="nombre" required>
            <label class="label">Nombre(s)</label>
            <input type="text" name="apellido" class="input" id="apellidos" required>
            <label class="label">Apellidos</label>
            <input type="text" name="usuario" class="input" id="usuario" required>
            <label class="label">Usuario</label>
            <input type="password" name="contra1" class="input" id="contra1" required>
            <label class="label">Contraseña</label>
            <input type="password" name="contra2" class="input" id="contra2" required>
            <label class="label">Confirmar contraseña</label>
            <input type="submit" value="Registrarse" name="registrar">
            <p>Ya tienes una cuenta?<a href="iniciar.php">Iniciar sesion</a></p>
        </form>
    </div>
</body>
</html>