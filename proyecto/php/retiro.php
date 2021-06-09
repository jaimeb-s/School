<?php

require 'database.php';

session_start();

$diahoy = date("Y") . "-" . date("m") . "-" . date("d");
$hora = date("H") . ":" . date("i") . ":" . date("s");
$retiroxdia = 0;
$mensaje = "";

if (isset($_POST['retirar'])) {
    try {

        $consulta = $conexion->prepare('SELECT * FROM movimientos WHERE cuenta=:dato AND fecha=:dato2 AND operacion="Retiro de efectivo"');
        $consulta->execute(array(':dato' => $_SESSION['cuenta'], ':dato2' => $diahoy));

        $resultados = $consulta->fetchAll();
        foreach ($resultados as $reti ) {
            $retiroxdia = $retiroxdia + $reti['monto'];
        }

        if ($_POST['retiro'] > $_SESSION['monto']) {
            $mensaje = "No tiene suficiente dinero para retirar";
        } else {
            if ($_POST['retiro'] > 7000 || ($retiroxdia + $_POST['retiro']) > 7000) {
                $mensaje = "No puede retirar mas de $7000 por dia";
            } else {
                $consulta = $conexion->prepare('INSERT INTO retiros (
                    id, cuenta, monto, fecha) VALUES (
                        null, :cuenta, :monto, :fecha)');
                $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
                $consulta->bindParam(':monto', $_POST['retiro']);
                $consulta->bindParam(':fecha', $diahoy);
                $consulta->execute();

                $consulta = $conexion->prepare('INSERT INTO movimientos(
                    id_movimiento, cuenta, monto, operacion, fecha, hora
                ) VALUES (null, :cuenta, :monto, "Retiro de efectivo", :fecha, :hora)');
                $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
                $consulta->bindParam(':monto', $_POST['retiro']);
                $consulta->bindParam(':fecha', $diahoy);
                $consulta->bindParam(':hora', $hora);
                $consulta->execute();

                $consulta = $conexion->prepare('SELECT * FROM cuentas WHERE cuenta=:cuenta');
                $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
                $consulta->execute();

                $resultados = $consulta->fetchAll();
                foreach ($resultados as $key) {
                    $montoanterior = $key['monto'];
                }

                $nuevomon = $montoanterior - $_POST['retiro'];

                $consulta = $conexion->prepare('UPDATE cuentas SET monto=:nuevomon WHERE cuenta=:cuenta;)');
                $consulta->bindParam(':nuevomon', $nuevomon);
                $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
                $consulta->execute();

                $_SESSION['retiro'] = $_POST['retiro'];

                $mensaje = "El retiro de " . $_POST['retiro'] . " fue exitoso";
            }
        }
    } catch (PDOException $th) {
        echo "Error: " . $th->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Retiro</title>
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
            <article id="formulario">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <label>Monto a retirar</label>
                    <input type="text" name="retiro">
                    <input type="submit" value="Retirar" name="retirar">
                </form>
            </article>
            <?php if(!empty($mensaje)): ?>
                <div class="mensaje">
                    <p> <?= $mensaje ?></p>
                </div>
            <?php endif; ?>
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