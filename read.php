<?php
$msg = $_GET['msg'] ?? '';
$decoded = $msg ? htmlspecialchars(urldecode(base64_decode($msg))) : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Baca Pesan</title>
</head>
<body>
  <h1>Pesan Rahasia:</h1>
  <?php if ($decoded): ?>
    <p><?= $decoded ?></p>
  <?php else: ?>
    <p>Tidak ada pesan.</p>
  <?php endif; ?>
</body>
</html>
