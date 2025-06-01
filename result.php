<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['message'])) {
    $message = $_POST['message'];
    $encoded = urlencode(base64_encode($message));
    $link = "https://" . $_SERVER['HTTP_HOST'] . "/read.php?msg=" . $encoded;
} else {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Link Rahasia</title>
</head>
<body>
  <h2>Link Pesan Rahasia:</h2>
  <p><a href="<?= $link ?>"><?= $link ?></a></p>
  <p><em>Link ini bisa dibuka oleh siapa saja yang tahu URL-nya.</em></p>
</body>
</html>
