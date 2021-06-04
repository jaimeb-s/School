<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/animacion.js"></script>
    <script src="../js/validar.js"></script>
</head>
<body onload="animacion()">
    <div id="contre">
        <h2><i class="bi bi-lock-fill"></i>Cambiar contraseña</h2>
        <form action="iniciar.php" method="post" onsubmit="return validar_cambiar_contra(this);">
            <input type="text" name="nombrec" class="input" id="nombre">
            <label class="label">Nombre</label>
            <input type="text" name="apellidosc" class="input" id="apellido">
            <label class="label">Apellidos</label>
            <input type="text" name="usuarioc" class="input" id="usuario">
            <label class="label">Usuario</label>
            <input type="password" name="contranuevac" class="input" id="contranueva">
            <label class="label">Contraseña nueva</label>
            <input type="submit" value="Cambiar contraseña" name="cambiar_contra"  id="boton">
            <p>Usuario nuevo?<a href="registro.php" id="link">Registrarse</a></p>
            <p>Ya tiene una cuenta?<a href="iniciar.php" id="link">Iniciar sesion</a></p>
        </form>
    </div>
</body>
</html>