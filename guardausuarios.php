<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultado del Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
 
<?php
$ema = $_POST["cor"];
$nom = $_POST["nom"];
 
$tipo    = '';
$titulo  = '';
$mensaje = '';
$pass_generado = '';
 
if (!$ema || !$nom) {
    $tipo    = 'error';
    $titulo  = 'Faltan datos';
    $mensaje = 'No se recibieron el correo o el nombre. Por favor vuelve al formulario.';
} else {
    date_default_timezone_set("America/Chihuahua");
 
    $host    = 'localhost';
    $db      = 'temperaturadb';
    $user    = 'root';
    $pass    = '';
    $charset = 'utf8mb4';
    $dsn     = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
 
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
 
        $stmt = $pdo->prepare("SELECT nombre FROM usuarios WHERE email = ?");
        $stmt->execute([$ema]);
 
        if ($row = $stmt->fetch()) {
            $tipo    = 'warning';
            $titulo  = 'Correo ya registrado';
            $mensaje = 'Este correo ya existe a nombre de: <strong>' . htmlspecialchars($row["nombre"]) . '</strong>.';
        } else {
            $generated_pass = bin2hex(openssl_random_pseudo_bytes(16));
            $sql  = "INSERT INTO usuarios(email, password, nombre) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$ema, $generated_pass, $nom]);
 
            $tipo          = 'success';
            $titulo        = '¡Registro exitoso!';
            $pass_generado = $generated_pass;
            $mensaje       = 'El usuario <strong>' . htmlspecialchars($nom) . '</strong> fue registrado con el correo <strong>' . htmlspecialchars($ema) . '</strong>.';
        }
    } catch (\PDOException $ex) {
        $tipo    = 'error';
        $titulo  = 'Error en la base de datos';
        $mensaje = htmlspecialchars($e->getMessage());
    }
}
 

$estilos = [
    'success' => [
        'card'   => 'border-green-200 bg-green-50',
        'icon'   => 'bg-green-100 text-green-600',
        'titulo' => 'text-green-800',
        'texto'  => 'text-green-700',
        'badge'  => 'bg-green-100 text-green-800 border border-green-200',
        'svg'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>',
    ],
    'warning' => [
        'card'   => 'border-yellow-200 bg-yellow-50',
        'icon'   => 'bg-yellow-100 text-yellow-600',
        'titulo' => 'text-yellow-800',
        'texto'  => 'text-yellow-700',
        'badge'  => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
        'svg'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>',
    ],
    'error'   => [
        'card'   => 'border-red-200 bg-red-50',
        'icon'   => 'bg-red-100 text-red-600',
        'titulo' => 'text-red-800',
        'texto'  => 'text-red-700',
        'badge'  => 'bg-red-100 text-red-800 border border-red-200',
        'svg'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>',
    ],
];
 
$e = isset($estilos[$tipo]) ? $estilos[$tipo] : $estilos['error'];
?>
 
  <div class="w-full max-w-md px-4">
 
    
    <div class="border rounded-xl p-6 <?= $e['card'] ?> shadow-sm">
 
      <div class="flex items-start gap-4">
       
        <div class="flex-shrink-0 w-10 h-10 rounded-full <?= $e['icon'] ?> flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <?= $e['svg'] ?>
          </svg>
        </div>
 
        
        <div class="flex-1">
          <h3 class="font-semibold text-base <?= $e['titulo'] ?>"><?= $titulo ?></h3>
          <p class="mt-1 text-sm <?= $e['texto'] ?>"><?= $mensaje ?></p>
 
          <?php if ($tipo === 'success' && $pass_generado): ?>
            <div class="mt-4">
              <p class="text-xs font-medium text-green-700 mb-1">Tu contraseña generada:</p>
              <code class="block w-full bg-white border border-green-200 text-green-900 text-sm font-mono px-3 py-2 rounded-lg break-all select-all">
                <?= htmlspecialchars($pass_generado) ?>
              </code>
              <p class="text-xs text-green-600 mt-1">Guárdala en un lugar seguro, no se mostrará de nuevo.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
 
    </div>
 
    
    <div class="mt-5 text-center">
      <a href="Registro.php" class="inline-block text-sm text-blue-600 hover:text-blue-800 hover:underline transition">
        ← Volver al formulario
      </a>
    </div>
 
  </div>
 
</body>
</html>