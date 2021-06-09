<?php

require 'database.php';

session_start();

$diahoy = date("Y") . "-" . date("m") . "-" . date("d");
$hora = date("H") . ":" . date("i") . ":" . date("s");

if (isset($_POST['servi'])) {
    try {

        if ($_POST['montoservicio'] > $_SESSION['monto']) {
            echo "No tiene suficiente dinero para pagar";
        } else {
            // Insertar en la tabla servicos
            $consulta = $conexion->prepare('INSERT INTO servicios (
                id, cuenta, servicio, monto, fecha, hora) VALUES (
                null, :cuenta, :servicio, :monto, :fecha, :hora)');
            $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
            $consulta->bindParam(':servicio', $_POST['servicio']);
            $consulta->bindParam(':monto', $_POST['montoservicio']);
            $consulta->bindParam(':fecha', $diahoy);
            $consulta->bindParam(':hora', $hora);
            $consulta->execute();

            // Tabla movimientos
            $consulta = $conexion->prepare('INSERT INTO movimientos (
                id_movimiento, cuenta, monto, operacion, fecha, hora) VALUES
                (null, :cuenta, :monto, "Pago de servicio", :fecha, :hora)');
            $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
            $consulta->bindParam(':monto', $_POST['montoservicio']);
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

            $nue_mon = $montoanterior - $_POST['montoservicio'];
            // Actualizar la cuenta que pago el servicio
            $consulta = $conexion->prepare('UPDATE cuentas SET monto=:nuevomonto WHERE cuenta=:cuenta;)');
            $consulta->bindParam(':nuevomonto', $nue_mon);
            $consulta->bindParam(':cuenta', $_SESSION['cuenta']);
            $consulta->execute();

            echo "El pago de su servicio de " . $_POST['servicio'] . " fue realizado exitodamente";
        }
    } catch (PDOException $th) {
        echo "Error: " . $th->getMessage();
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Servicios</title>
    <link rel="stylesheet" href="../css/principal.css">
</head>
<body>
    <header id="cabecera">
        <div>
            <h1><i class="bi bi-safe2-fill"></i>BancoTek</h1>
        </div>
        <div>
            <h2>Bienvenido Sr(a). <?php echo $_SESSION['nombre']; ?></h2>
        </div>
    </header>
    <nav id="navegacion">
        <div>
            <ul>
                <li><a href="menu.php" class="link">Principal</a></li>
                <li><a href="deposito.php" class="link">Deposito</a></li>
                <li><a href="retiro.php" class="link">Retiro</a></li>
                <li><a href="transferencia.php" class="link">Transferancia</a></li>
                <li><a href="servicio.php" class="link">Servicios</a></li>
                <li><a href="datos.php" class="link">Datos personales</a></li>
            </ul>
        </div>
    </nav>
    <section class="deposito">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Servicio a pagar</h2>
            <label for="">Nombre del servicio</label>
            <input type="text" name="servicio" id="">
            <br>
            <label for="">Monto a pagar</label>
            <input type="text" name="montoservicio" id="">
            <br>
            <input type="submit" value="Pagar servicio" name="servi">
        </form>
    </section>
    <footer id="barra_info">
        <div>
            <section id="titulo">
                <h1><i class="bi bi-safe2-fill"></i>BancoTek</h1>
            </section>
            <section id="link">
                <h2>Ir a</h2>
                <p><a href="menu.php">Principal</a></p>
                <p><a href="deposito.php">Deposito</a></p>
                <p><a href="retiro.php">Retiro</a></p>
                <p><a href="datos.php">Datos personales</a></p>
            </section>
            <section id="redes">
                <h2>Redes sociales</h2>
                <p><a href=""><i class="bi bi-facebook"></i> Facebook</a></p>
                <p><a href=""><i class="bi bi-twitter"></i>Twitter</a></p>
            </section>
            <section id="derechos">
                <address>Tlaxiaco, Oaxaca</address>
                <small>&copy; Derechos Reservados 2021</small>
            </section>
        </div>
    </footer>
</body>
</html>