<?php

//conectarse a la base de datos
require 'database.php';

// Registrarse 
if (isset($_POST['registrar'])) {
    $monto = 0;
    $usu = $_POST['usuario'];
    
    // Si las contraseñas son iguales
    if ($_POST['contra1'] == $_POST['contra2']) {
        $contrase = $_POST['contra1'];
        
        try {
            $consulta = $conexion->prepare('INSERT INTO cuentas (cuenta, nombre, apellidos, monto, usuario, contra)
                VALUES (null, :nombre, :apellido, :monto, :usuario, :contras)');
            $consulta->bindParam(':nombre', $_POST['nombre']);
            $consulta->bindParam(':apellido', $_POST['apellido']);
            $consulta->bindParam(':monto', $monto);
            $consulta->bindParam(':usuario', $_POST['usuario']);
            $consulta->bindParam(':contras', $contrase);
            $consulta->execute();

        } catch (PDOException $th) {
            echo "Error: " . $th->getMessage();
        }
    } else {
        header('Location: registro.php');
    }
}

// Cambiar contraseña
if (isset($_POST['cambiar_contra'])) {
    $nom = $_POST['nombrec'];
    $ape = $_POST['apellidosc'];
    $use = $_POST['usuarioc'];

    try {

        $consulta = $conexion->prepare('SELECT * FROM cuentas');
        $consulta->execute();

        $resultados = $consulta->fetchAll();

        foreach ($resultados as $key ) {
            if ($key['nombre'] == $nom && $key['apellidos'] == $ape && $key['usuario'] == $use) {
                
                $consulta = $conexion->prepare('UPDATE cuentas SET contra=:contranueva 
                    WHERE nombre=:nombre AND apellidos=:apellidos AND usuario=:usuario;)');
                $consulta->bindParam(':contranueva', $_POST['contranuevac']);
                $consulta->bindParam(':nombre', $nom);
                $consulta->bindParam(':apellidos', $ape);
                $consulta->bindParam(':usuario', $use);
                $consulta->execute();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/animacion.js"></script>
    <script src="../js/validar.js"></script>
</head>
<body onload="animacion()">
    <div id="contre">
        <h2><i class="bi bi-door-open-fill"></i>Iniciar sesion</h2>
        <form action="menu.php" method="post" onsubmit="return validar_inicio(this);">
            <input type="text" name="usuario"  class="input" id="usuario">
            <label class="label">Usuario</label>
            <input type="password" name="contrase"  class="input" id="contra">
            <label class="label">Contraseña</label>
            <input type="submit" value="Iniciar sesion" id="boton">
            <p>Usuario nuevo?<a href="registro.php" id="link">Registrarse</a></p>
            <p>A olvidado su contraseña?<a href="cambiar_con.php" id="link">Cambiar contraseña</a></p>
        </form>
    </div>
</body>
</html>