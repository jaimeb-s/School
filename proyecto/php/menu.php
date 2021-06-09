<?php

require 'database.php';

session_start();

if ($_POST['usuario'] && $_POST['contrase']) {
    $usuario = $_POST['usuario'];
    $contra = $_POST['contrase'];

    try {
        $ban = 0;

        $consulta = $conexion->prepare('SELECT * FROM cuentas');
        $consulta->execute();

        $resultados = $consulta->fetchAll();

        foreach ($resultados as $key) {
            if ($key['usuario'] == $usuario && $key['contra'] == $contra) {
                //echo "el usuario y la contraseña fueron correctos";
                $ban = 1;

                $_SESSION['cuenta'] = $key['cuenta'];
                $_SESSION['nombre'] = $key['nombre'] . " " . $key['apellidos'];
                $_SESSION['monto'] = $key['monto'];
                $_SESSION['usu'] = $key['usuario'];
                $_SESSION['con'] = $key['contra'];
            }
        }
        if ($ban == 0) {
            header('Location: iniciar.php');
        }
    } catch (PDOException $th) {
        echo "Error: " . $th->getMessage();
    }
} else {
    header('Location: iniciar.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Menu principal</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <header>
        <div>
            <h1><i class="bi bi-safe2-fill"></i>BancoTek</h1>
            <?php if(isset($_SESSION['usu'])): ?>
              <a href="salir.php" class="salir">Salir</a>
            <?php endif; ?>
        </div>
    </header>
    <div id="contenedor">
        <nav>
            <div>
                <ul>
                    <li><a href="menu.php" class="link">Principal</a></li>
                    <li><a href="deposito.php" class="link">Deposito</a></li>
                    <li><a href="retiro.php" class="link">Retiro</a></li>
                    <li><a href="transferencia.php" class="link">Transferencia</a></li>
                    <li><a href="servicio.php" class="link">Servicios</a></li>
                </ul>
            </div>
        </nav>
        <section id="seccion1">
            <article id="info">
                <div>
                    <h2>Saldo: <i class="bi bi-currency-dollar"></i><?php echo $_SESSION['monto']; ?></h2>
                    <p>Bienvenido a BancoTek donde usted podra hacer depositos, retiros, transferencias e incluso puede pagar los diferentes servicios que utiliza.</p>
                    <p>Nuestro objetivo es brindarle un buen servicio para que se sienta agusto, para no complicarle la vida.</p>
                    <p>Con BancoTek usted tiene a su disposicion algunos servicios para su dinero.</p>
                    <p>Agradecemos el poder elegirnos para brindarle dichos servicios y esperamos que les sea de su agrado.</p>
                </div>
                </article>
        </section>
        <section id="seccion2">
            <div>
                <i class="bi bi-person-circle"></i>
                <h2>Bienvenido Sr(a). <?php echo $_SESSION['nombre']; ?></h2>
            </div>
        </section>
    </div>
    <footer>
        <div>
            <section>
                <h1><i class="bi bi-safe2-fill"></i>BancoTek</h1>
            </section>
            <section id="link">
                <h2>Ir a</h2>
                <p><a href="menu.php">Principal</a></p>
                <p><a href="deposito.php">Deposito</a></p>
                <p><a href="retiro.php">Retiro</a></p>
                <p><a href="transferencia.php">Transferencia</a></p>
                <p><a href="servicio.php">Servicios</a></p>
            </section>
            <section id="redes">
                <h2>Redes sociales</h2>
                <p><a href="#"><i class="bi bi-facebook"></i>Facebook</a></p>
                <p><a href="#"><i class="bi bi-twitter"></i>Twitter</a></p>
            </section>
            <section id="derechos">
                <address>Tlaxiaco, Oaxaca</address>
                <small>&copy; Derechos Reservados 2021</small>
            </section>
        </div>
    </footer>
</body>
</html>