<?php
$messageDecoded = '';
$error = '';

if (isset($_GET['msg'])) {
    $encoded = $_GET['msg'];
    try {
        $messageDecoded = urldecode(base64_decode($encoded));
    } catch (Exception $e) {
        $error = "Link pesan tidak valid atau sudah rusak.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Rahasia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style disalin dari index.html -->
    <style>
        /* ...[CSS-mu tetap, tidak berubah, tempel dari kode kamu]... */
    </style>
</head>
<body>
<div class="container">
    <div class="logo">🔐</div>
    <h1 id="title"><?php echo $messageDecoded ? 'Pesan Rahasia Diterima!' : 'Pesan Rahasia'; ?></h1>
    <div class="subtitle" id="subtitle">
        <?php echo $messageDecoded ? 'Seseorang mengirimkan pesan untukmu' : 'Tulis pesan rahasia dan bagikan dengan teman Anda'; ?>
    </div>

    <?php if (!$messageDecoded && !$error): ?>
    <!-- FORM -->
    <div id="createForm">
        <div class="form-group">
            <label for="message">Tulis Pesan Rahasia Dan Bagikan Dengan Teman Anda</label>
            <textarea id="message" placeholder="Ketik pesan rahasiamu di sini...&#10;&#10;" required></textarea>
        </div>
        <button type="button" class="btn" onclick="createSecretLink()">🔗 Buat Link Rahasia</button>
    </div>

    <div id="result" class="result">
        <h3>✅ Link Rahasia Berhasil Dibuat!</h3>
        <p>Link ini berisi pesan rahasiamu:</p>
        <div class="link-container"><div id="generatedLink"></div></div>
        <button class="copy-btn" onclick="copyLink()">📋 Salin Link</button>
        <p style="margin-top: 15px; font-size: 0.9rem; color: #666;">
            💡 <strong>Tips:</strong> Bagikan link ini kepada orang yang ingin kamu kirimi pesan. Link ini aman.
        </p>
        <button class="btn new-message-btn" onclick="createNewMessage()">✏️ Buat Pesan Baru</button>
    </div>
    <?php endif; ?>

    <?php if ($messageDecoded): ?>
    <div id="messageDisplay" class="message-display" style="display: block;">
        <h3>📬 Pesan Untukmu:</h3>
        <div style="background: #2a2a2a; color: #e0e0e0; padding: 15px; border-radius: 8px; border: 2px solid #28a745; white-space: pre-wrap;">
            <?php echo htmlspecialchars($messageDecoded); ?>
        </div>
        <button class="btn new-message-btn" onclick="createNewMessage()">✏️ Buat Pesan Baru</button>
    </div>
    <?php endif; ?>

    <?php if ($error): ?>
    <div id="errorDisplay" class="error" style="display: block;">
        <h3>❌ Oops!</h3>
        <div><?php echo $error; ?></div>
        <button class="btn new-message-btn" onclick="createNewMessage()">✏️ Buat Pesan Baru</button>
    </div>
    <?php endif; ?>
</div>

<!-- Script tetap dari HTML -->
<script>
function createSecretLink() {
    const messageText = document.getElementById('message').value.trim();
    if (!messageText) {
        alert('Pesan tidak boleh kosong!');
        return;
    }

    const encoded = btoa(encodeURIComponent(messageText));
    const link = `${window.location.origin}${window.location.pathname}?msg=${encoded}`;

    document.getElementById('generatedLink').textContent = link;
    document.getElementById('createForm').style.display = 'none';
    document.getElementById('result').classList.add('show');
    document.getElementById('title').textContent = 'Link Berhasil Dibuat!';
    document.getElementById('subtitle').textContent = 'Bagikan link di bawah ini kepada penerima';
}

function copyLink() {
    const text = document.getElementById('generatedLink').textContent;
    navigator.clipboard.writeText(text).then(() => {
        const btn = document.querySelector('.copy-btn');
        btn.textContent = "✅ Tersalin!";
        btn.classList.add('copied');
    });
}

function createNewMessage() {
    window.location.href = window.location.pathname;
}
</script>
</body>
</html>
