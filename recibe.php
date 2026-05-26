<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ?>
    <form method="POST">
        Ubicación: <input type="text" name="ubi" value="Redes"><br>
        Temperatura: <input type="text" name="tem" value="25.5"><br>
        <button type="submit">Enviar prueba</button>
    </form>
    <?php
    exit;
}
$ubi = $_POST["ubi"];
$tem = $_POST["tem"];

if (empty($ubi) || empty($tem)) {
    http_response_code(400);
    echo "Faltan datos";
    exit;
}

date_default_timezone_set("America/Chihuahua");
$fecha = date("Y-m-d H:i:s"); // también tenías "y" minúscula (año de 2 dígitos)

$host    = 'localhost';
$db      = 'temperaturadb';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo  = new PDO($dsn, $user, $pass, $options);
    $sql  = "INSERT INTO temperaturas (Lugar, Fecha, Temp) VALUES (:ubi, :fecha, :tem)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':ubi',   $ubi);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':tem',   $tem);
    $stmt->execute();

    echo "OK"; // El ESP32 puede verificar esta respuesta
} catch (\PDOException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}
?>