<?php
// Carga configuración
$env = file_exists(__DIR__ . '/env.php') ? require __DIR__ . '/env.php' : require __DIR__ . '/env.sample.php';

$dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', 
  $env['DB_HOST'], $env['DB_PORT'], $env['DB_NAME']);

try {
  $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Throwable $e) {
  http_response_code(500);
  echo "<h1>Error de conexión</h1>";
  echo "<p>No se pudo conectar a la base de datos. Detalle:</p>";
  echo "<pre>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</pre>";
  exit;
}
