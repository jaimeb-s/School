<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/style1.css">
    <script src="../js/animacion.js"></script>
    <script src="../js/validar.js"></script>
</head>
<body onload="animacion()">
    <div id="conte">
        <i class="bi bi-lock-fill"></i>
        <h1>Cambiar contraseña</h1>
        <form action="iniciar.php" method="post" onsubmit="return validar_cambiar_contra(this);">
            <input type="text" name="nombrec" class="input" id="nombre" required>
            <label class="label">Nombre</label>
            <input type="text" name="apellidosc" class="input" id="apellido" required>
            <label class="label">Apellidos</label>
            <input type="text" name="usuarioc" class="input" id="usuario" required>
            <label class="label">Usuario</label>
            <input type="password" name="contranuevac" class="input" id="contranueva" required>
            <label class="label">Contraseña nueva</label>
            <input type="submit" value="Cambiar contraseña" name="cambiar_contra">
            <p>Usuario nuevo?<a href="registro.php">Registrarse</a></p>
            <p>Ya tiene una cuenta?<a href="iniciar.php">Iniciar sesion</a></p>
        </form>
    </div>
</body>
</html>