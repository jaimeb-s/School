<?php

$host = 'localhost';
$db = 'banco';
$user = 'root';
$pass = '';

try {
    $conexion = new PDO('mysql:host=' . $host . ';dbname=' . $db, $user, $pass);
} catch (PDOExeption $th) {
    echo "Error: " . $th->getMessage();
}

?>