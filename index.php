<?php
function escapeHtml($string) {
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Decode pesan dari URL
if (isset($_GET['msg'])) {
    $decoded = base64_decode($_GET['msg']);
    $message = urldecode($decoded);
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Pesan Rahasia</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <div class="container">
            <div class="logo">📬</div>
            <h1>Pesan Rahasia Diterima!</h1>
            <div class="subtitle">Seseorang mengirimkan pesan untukmu</div>
            <div class="message-display">
                <div style="background:#2a2a2a;padding:20px;border-radius:8px;border:2px solid #28a745;">
                    <?= escapeHtml($message) ?>
                </div>
            </div>
            <a href="index.html"><button class="btn new-message-btn">✏️ Buat Pesan Baru</button></a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Encode pesan dari POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    if ($message !== '') {
        $encoded = base64_encode(urlencode($message));
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?msg=$encoded";
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <title>Link Berhasil Dibuat</title>
            <link rel="stylesheet" href="style.css" />
        </head>
        <body>
            <div class="container">
                <div class="logo">✅</div>
                <h1>Link Berhasil Dibuat!</h1>
                <div class="subtitle">Bagikan link berikut:</div>
                <div class="link-container"><?= escapeHtml($url) ?></div>
                <a href="index.html"><button class="btn new-message-btn">✏️ Buat Pesan Baru</button></a>
            </div>
        </body>
        </html>
        <?php
        exit;
    } else {
        header("Location: index.html");
        exit;
    }
}
?>
