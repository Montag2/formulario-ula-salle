<?php
require __DIR__ . '/db.php';

// Consulta simple (ejemplo SELECT)
$stmt = $pdo->query("SELECT id, full_name, email, subject, program, phone, created_at FROM contacts ORDER BY created_at DESC");
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contactos (admin)</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1>Admin | Contactos</h1>
      <nav>
        <a href="index.html">Inicio</a>
        <a href="contacto.html">Formulario</a>
        <a href="list_contacts.php" class="active">Ver contactos</a>
      </nav>
    </div>
  </header>

  <main class="container">
    <h2>Listado de contactos</h2>
    <p>Resultados de la consulta SELECT a la tabla <code>contacts</code>.</p>
    <table class="table">
      <thead>
        <tr>
          <th>#</th><th>Nombre</th><th>Email</th><th>Asunto</th><th>Programa</th><th>Teléfono</th><th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['id']) ?></td>
            <td><?= htmlspecialchars($r['full_name']) ?></td>
            <td><?= htmlspecialchars($r['email']) ?></td>
            <td><?= htmlspecialchars($r['subject']) ?></td>
            <td><?= htmlspecialchars($r['program']) ?></td>
            <td><?= htmlspecialchars($r['phone']) ?></td>
            <td><?= htmlspecialchars($r['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
        <?php if (!$rows): ?>
          <tr><td colspan="7">Sin registros aún. Envía el formulario para crear uno.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>
</body>
</html>
