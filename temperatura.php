<?php
$conexion = mysqli_connect("localhost", "root", "", "TemperaturaDB");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql = "SELECT 
            Lugares.NomLugar,
            Fecha.Fecha,
            Fecha.Hora,
            Temperatura.Temperatura
        FROM Lugares
        INNER JOIN Fecha
            ON Lugares.Fecha_idFecha = Fecha.idFecha
        INNER JOIN Temperatura 
            ON Lugares.Temperatura_idTemperatura = Temperatura.idTemperatura
        ORDER BY Fecha.Fecha, Fecha.Hora";

$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$labels = [];
$lugares = [];

while($fila = mysqli_fetch_assoc($resultado)){
    $label = $fila['Fecha'] . " " . $fila['Hora'];
    
    if (!in_array($label, $labels)) {
        $labels[] = $label;
    }

    $lugar = $fila['NomLugar'];
    if (!isset($lugares[$lugar])) {
        $lugares[$lugar] = [];
    }
    $lugares[$lugar][$label] = $fila['Temperatura'];
}


$colores = [
    'rgba(255, 99, 132, 1)',
    'rgba(54, 162, 235, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(255, 205, 86, 1)',
    'rgba(153, 102, 255, 1)',
    'rgb(12, 226, 241)',
    'rgb(192, 0, 182)',
    'rgb(0, 128, 0)',
    'rgb(234, 250, 9)',
    'rgb(131, 0, 0)',
];

$datasets = [];
$i = 0;
foreach ($lugares as $nombre => $datos) {
    $temperaturas = [];
    foreach ($labels as $label) {
        $temperaturas[] = isset($datos[$label]) ? $datos[$label] : null;
    }
    $color = $colores[$i % count($colores)];
    $datasets[] = [
        "label" => $nombre,
        "data" => $temperaturas,
        "borderColor" => $color,
        "backgroundColor" => str_replace('1)', '0.2)', $color),
        "tension" => 0.4,
        "fill" => false
    ];
    $i++;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Temperatura</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 p-10">

<h1 class="text-3xl font-bold text-center mb-6">Gráfica de Temperatura</h1>

<div class="bg-white p-6 rounded-xl shadow-lg w-3/4 mx-auto">
    <canvas id="graficaTemp"></canvas>
</div>

<script>
const etiquetas = <?php echo json_encode($labels); ?>;
const datasets = <?php echo json_encode($datasets); ?>;

new Chart(document.getElementById("graficaTemp"), {
    type: 'line',
    data: {
        labels: etiquetas,
        datasets: datasets
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: 'Temperatura por Lugar'
            }
        },
        scales: {
            y: {
                title: {
                    display: true,
                    text: 'Temperatura °C'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Fecha y Hora'
                }
            }
        }
    }
});
</script>
</body>
</html>