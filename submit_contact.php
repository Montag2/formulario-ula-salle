<?php
require __DIR__ . '/db.php';

// Validar entrada
$fields = ['full_name','email','subject','message','program','phone'];
$data = [];
foreach ($fields as $f) {
  $data[$f] = isset($_POST[$f]) ? trim($_POST[$f]) : '';
}

if ($data['full_name'] === '' || $data['email'] === '' || $data['subject'] === '' || $data['message'] === '') {
  http_response_code(422);
  echo "<!doctype html><meta charset='utf-8'><p>Faltan campos obligatorios.</p><a href='contacto.html'>Volver</a>";
  exit;
}

// Insertar
$sql = "INSERT INTO contacts (full_name,email,subject,message,program,phone,created_at)
        VALUES (:full_name,:email,:subject,:message,:program,:phone,NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':full_name' => $data['full_name'],
  ':email'     => $data['email'],
  ':subject'   => $data['subject'],
  ':message'   => $data['message'],
  ':program'   => $data['program'],
  ':phone'     => $data['phone'],
]);

// Redirigir a gracias
header('Location: thanks.html');
