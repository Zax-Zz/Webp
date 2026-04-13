<?php
function generateRandomSubdomain($length = 5) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789-';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Cahyo SR | Portal Webp</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet"/>
<style>
  * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

  body {
    background: #0a0a0f;
    color: #e2e8f0;
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* Animated background */
  body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(ellipse at 20% 20%, rgba(0,80,255,0.08) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(139,92,246,0.08) 0%, transparent 50%);
    animation: bgPulse 8s ease-in-out infinite alternate;
    pointer-events: none;
    z-index: 0;
  }

  @keyframes bgPulse {
    0% { transform: scale(1) rotate(0deg); }
    100% { transform: scale(1.1) rotate(3deg); }
  }

  /* Header */
  .header {
    background: rgba(10,10,20,0.85);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(0,80,255,0.2);
    position: sticky;
    top: 0;
    z-index: 100;
    animation: slideDown 0.5s ease;
  }

  @keyframes slideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
  }

  .logo-text {
    background: linear-gradient(135deg, #0050FF, #7c3aed, #06b6d4);
    background-size: 200% 200%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: gradientShift 3s ease infinite;
  }

  @keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
  }

  .search-input {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(0,80,255,0.3);
    color: #e2e8f0;
    transition: all 0.3s ease;
  }

  .search-input:focus {
    outline: none;
    border-color: #0050FF;
    background: rgba(0,80,255,0.1);
    box-shadow: 0 0 20px rgba(0,80,255,0.2);
  }

  .search-input::placeholder { color: rgba(255,255,255,0.35); }

  /* Info Modal */
  .info-modal {
    background: rgba(10,10,25,0.95);
    backdrop-filter: blur(30px);
    border: 1px solid rgba(0,80,255,0.3);
    box-shadow: 0 25px 60px rgba(0,0,0,0.6), 0 0 40px rgba(0,80,255,0.1);
  }

  /* Order Button in Modal */
  .order-btn-modal {
    background: linear-gradient(135deg, #25D366, #128C7E);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(37,211,102,0.3);
  }
  .order-btn-modal:hover {
    transform: scale(1.05) translateY(-2px);
    box-shadow: 0 8px 25px rgba(37,211,102,0.5);
  }

  /* Section title */
  .section-title {
    position: relative;
    display: inline-block;
  }
  .section-title::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #0050FF, #7c3aed);
    animation: expandLine 1s ease 0.5s forwards;
  }
  @keyframes expandLine {
    to { width: 100%; }
  }

  /* Product Card */
  .product-card {
    background: rgba(15,15,30,0.8);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: fadeInUp 0.5s ease both;
    position: relative;
  }

  .product-card::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    padding: 1px;
    background: linear-gradient(135deg, transparent, rgba(0,80,255,0.3), transparent);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.3s;
  }

  .product-card:hover {
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.5), 0 0 30px rgba(0,80,255,0.15);
    border-color: rgba(0,80,255,0.3);
  }

  .product-card:hover::before { opacity: 1; }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Badge */
  .badge-digital {
    background: linear-gradient(135deg, rgba(0,80,255,0.8), rgba(124,58,237,0.8));
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    font-size: 10px;
    letter-spacing: 0.5px;
  }

  /* Product image wrapper */
  .img-wrapper {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0a0a1f, #0d0d2b);
  }

  .img-wrapper img {
    transition: transform 0.5s ease;
    width: 100%;
    height: 140px;
    object-fit: cover;
  }

  .product-card:hover .img-wrapper img {
    transform: scale(1.08);
  }

  .img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 60%);
  }

  /* Card body */
  .card-body {
    padding: 10px 12px 6px;
    background: rgba(10,10,25,0.9);
  }

  .seller-tag {
    background: rgba(0,80,255,0.15);
    border: 1px solid rgba(0,80,255,0.3);
    color: #60a5fa;
    font-size: 10px;
    border-radius: 6px;
    padding: 2px 8px;
    display: inline-block;
    margin-bottom: 4px;
  }

  .product-name {
    color: #e2e8f0;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.3;
  }

  /* CTA Button */
  .btn-buat {
    width: 100%;
    padding: 10px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .btn-buat::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
    transition: left 0.5s;
  }

  .btn-buat:hover::before { left: 100%; }

  .btn-blue {
    background: linear-gradient(135deg, #0050FF, #2563eb);
    color: white;
  }
  .btn-blue:hover {
    background: linear-gradient(135deg, #0040cc, #1d4ed8);
    box-shadow: 0 5px 20px rgba(0,80,255,0.4);
    transform: translateY(-1px);
  }

  .btn-orange {
    background: linear-gradient(135deg, #F97316, #ea580c);
    color: white;
  }
  .btn-orange:hover {
    background: linear-gradient(135deg, #ea6f0f, #c2410c);
    box-shadow: 0 5px 20px rgba(249,115,22,0.4);
    transform: translateY(-1px);
  }

  /* Order Script floating button */
  .fab-order {
    position: fixed;
    bottom: 24px;
    right: 20px;
    z-index: 200;
    background: linear-gradient(135deg, #25D366, #128C7E);
    color: white;
    border-radius: 50px;
    padding: 14px 20px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 8px 30px rgba(37,211,102,0.4);
    display: flex;
    align-items: center;
    gap: 8px;
    animation: fabBounce 2s ease-in-out infinite, slideUp 0.6s ease 0.3s both;
    transition: all 0.3s ease;
  }

  .fab-order:hover {
    transform: scale(1.05) translateY(-3px);
    box-shadow: 0 12px 40px rgba(37,211,102,0.6);
  }

  @keyframes fabBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Pulse ring on FAB */
  .fab-order::after {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50px;
    border: 2px solid rgba(37,211,102,0.4);
    animation: pulseRing 2s ease-in-out infinite;
  }

  @keyframes pulseRing {
    0%, 100% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.08); opacity: 0; }
  }

  /* Notification badge on card count */
  .stats-bar {
    background: rgba(0,80,255,0.08);
    border: 1px solid rgba(0,80,255,0.15);
    border-radius: 12px;
    padding: 10px 16px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .stat-item {
    text-align: center;
  }

  .stat-num {
    font-size: 18px;
    font-weight: 800;
    background: linear-gradient(135deg, #0050FF, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .stat-label {
    font-size: 10px;
    color: rgba(255,255,255,0.4);
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Scroll stagger animation */
  .product-card:nth-child(1)  { animation-delay: 0.05s; }
  .product-card:nth-child(2)  { animation-delay: 0.10s; }
  .product-card:nth-child(3)  { animation-delay: 0.15s; }
  .product-card:nth-child(4)  { animation-delay: 0.20s; }
  .product-card:nth-child(5)  { animation-delay: 0.25s; }
  .product-card:nth-child(6)  { animation-delay: 0.30s; }
  .product-card:nth-child(7)  { animation-delay: 0.35s; }
  .product-card:nth-child(8)  { animation-delay: 0.40s; }
  .product-card:nth-child(9)  { animation-delay: 0.45s; }
  .product-card:nth-child(10) { animation-delay: 0.50s; }
  .product-card:nth-child(n+11) { animation-delay: 0.55s; }

  /* Toast */
  .toast {
    position: fixed;
    bottom: 80px;
    left: 50%;
    transform: translateX(-50%) translateY(20px);
    background: rgba(15,15,30,0.95);
    border: 1px solid rgba(0,80,255,0.3);
    color: #e2e8f0;
    padding: 10px 20px;
    border-radius: 50px;
    font-size: 13px;
    opacity: 0;
    pointer-events: none;
    transition: all 0.4s ease;
    z-index: 300;
    white-space: nowrap;
    backdrop-filter: blur(20px);
  }

  .toast.show {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }

  /* Shimmer loading skeleton */
  @keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
  }

  /* Close button */
  .close-btn {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50%;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    color: rgba(255,255,255,0.6);
    font-size: 18px;
  }

  .close-btn:hover {
    background: rgba(255,50,50,0.2);
    border-color: rgba(255,50,50,0.4);
    color: white;
    transform: rotate(90deg);
  }

  /* Main content */
  main {
    position: relative;
    z-index: 1;
  }
</style>
</head>
<body>

<!-- Info Modal -->
<div id="info-message" class="hidden fixed inset-0 flex items-center justify-center z-50 px-4" style="background: rgba(0,0,0,0.7); backdrop-filter: blur(6px);">
  <div class="info-modal rounded-2xl p-6 w-full max-w-sm flex flex-col items-center gap-4 transform transition-all duration-500 scale-95 opacity-0" id="modal-inner">
    
    <!-- Icon -->
    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-600 to-violet-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
      <i class="fas fa-globe text-white text-2xl"></i>
    </div>

    <!-- Text -->
    <div class="text-center">
      <h3 class="font-bold text-white text-lg mb-1">Selamat Datang! 👋</h3>
      <p class="text-sm text-gray-400 leading-relaxed">
        Scroll ke bawah untuk melihat semua template tersedia.<br>
        Butuh script custom? Order langsung via WhatsApp!
      </p>
    </div>

    <!-- Order Script Button -->
    <a href="https://chat.whatsapp.com/FJqhd0sqsBz8ke16DbDMca?mode=gi_t" 
       target="_blank"
       class="order-btn-modal flex items-center gap-2 text-white font-bold px-6 py-3 rounded-full text-sm w-full justify-center">
      <i class="fab fa-whatsapp text-lg"></i>
      <span>Download Script</span>
    </a>

    <!-- Close -->
    <button aria-label="Tutup" class="close-btn" onclick="closeInfo()">
      <i class="fas fa-times text-xs"></i>
    </button>
  </div>
</div>

<!-- Header -->
<header class="header px-4 py-3 flex items-center gap-3">
  <div class="flex items-center gap-2 shrink-0">
    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-600 to-violet-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
      <i class="fas fa-globe text-white text-xs"></i>
    </div>
    <span class="logo-text font-extrabold text-lg tracking-tight">Cahyo SR</span>
  </div>

  <div class="flex-1 relative">
    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
    <input
      class="search-input w-full rounded-full py-2 pl-8 pr-4 text-sm placeholder-gray-500 focus:outline-none"
      id="search"
      placeholder="Cari template..."
      type="search"
      oninput="filterCards(this.value)"
    />
  </div>

  <a href="https://wa.me/6283896211964?text=Halo%20kak%20Cahyo%20SR%2C%20saya%20mau%20order%20script!" 
     target="_blank"
     class="shrink-0 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-3 py-2 rounded-full flex items-center gap-1 shadow-lg shadow-green-500/25 hover:scale-105 transition-transform">
    <i class="fab fa-whatsapp"></i>
    <span class="hidden sm:inline">Order</span>
  </a>
</header>

<!-- Main -->
<main class="px-4 pt-5 pb-28">

  <!-- Stats bar -->
  <div class="stats-bar">
    <div class="stat-item">
      <div class="stat-num">18+</div>
      <div class="stat-label">Template</div>
    </div>
    <div class="w-px h-8 bg-blue-900/50"></div>
    <div class="stat-item">
      <div class="stat-num">100%</div>
      <div class="stat-label">Auto Deploy</div>
    </div>
    <div class="w-px h-8 bg-blue-900/50"></div>
    <div class="stat-item">
      <div class="stat-num">24/7</div>
      <div class="stat-label">Support</div>
    </div>
  </div>

  <!-- Title -->
  <div class="flex items-center justify-between mb-4">
    <h2 class="section-title font-extrabold text-base text-white">
      <i class="fas fa-fire text-orange-500 mr-2 text-sm"></i>Produk Terbaru
    </h2>
    <span class="text-xs text-gray-500 bg-gray-800/50 px-2 py-1 rounded-full" id="card-count"></span>
  </div>

  <!-- Grid -->
  <div class="grid grid-cols-2 gap-3" id="product-grid">

<?php
$products = [
  ['nomor'=>1,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/1.jpg',  'name'=>'MediaFire ZIP',                 'btn'=>'orange'],
  ['nomor'=>21, 'img'=>'https://cdn.jsdelivr.net/gh/alex-hostingg/img@main/20251229_101305.jpg','name'=>'Codashop ML',                 'btn'=>'orange'],
  ['nomor'=>10, 'img'=>'https://cdn.jsdelivr.net/gh/alex-hostingg/img@main/20260313_025412.jpg','name'=>'Coda Shop FF',                'btn'=>'blue'],
  ['nomor'=>2,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/2.jpg',  'name'=>'MediaFire MP4',                 'btn'=>'orange'],
  ['nomor'=>3,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/3.jpg',  'name'=>'Download Aplikasi 18+',         'btn'=>'orange'],
  ['nomor'=>4,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/4.jpg',  'name'=>'Grup WA V1',                    'btn'=>'orange'],
  ['nomor'=>5,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/5.jpg',  'name'=>'Grup WA V2',                    'btn'=>'orange'],
  ['nomor'=>7,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/7.jpg',  'name'=>'Facebook 18+',                  'btn'=>'orange'],
  ['nomor'=>9,  'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/9.jpg',  'name'=>'Free Fire Beta',                'btn'=>'orange'],
  ['nomor'=>11, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/11.jpg', 'name'=>'Mobile Legends Beta',           'btn'=>'blue'],
  ['nomor'=>12, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/12.jpg', 'name'=>'Grup Telegram V1',              'btn'=>'blue'],
  ['nomor'=>13, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/13.jpg', 'name'=>'Grup Telegram V2',              'btn'=>'blue'],
  ['nomor'=>14, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/14.jpg', 'name'=>'Videy V1',                     'btn'=>'blue'],
  ['nomor'=>15, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/15.jpg', 'name'=>'Videy V2',                     'btn'=>'blue'],
  ['nomor'=>16, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/16.jpg', 'name'=>'YouTube V1',                   'btn'=>'blue'],
  ['nomor'=>17, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/17.jpg', 'name'=>'YouTube V2',                   'btn'=>'blue'],
  ['nomor'=>18, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/18.jpg', 'name'=>'Download Aplikasi 18+ Avcode', 'btn'=>'blue'],
  ['nomor'=>20, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/20.jpg', 'name'=>'Join Channel WA 18+',          'btn'=>'blue'],
  ['nomor'=>23, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/23.jpg', 'name'=>'Grup Massager 18+',            'btn'=>'blue'],
  ['nomor'=>24, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/24.jpg', 'name'=>'Lives FB 18+',                 'btn'=>'blue'],
  ['nomor'=>29, 'img'=>'https://cdn.jsdelivr.net/gh/cdn-aryatqhio/img@main/tampilan/29.jpg', 'name'=>'Mobile Legends',               'btn'=>'blue'],
];
foreach ($products as $p): ?>

<form method="post" action="proses.php" class="product-card" data-name="<?php echo strtolower($p['name']); ?>">
  <!-- Badge -->
  <div class="absolute top-2 left-2 z-10 badge-digital text-white px-2 py-0.5 rounded-md flex items-center gap-1 font-semibold">
    <i class="fas fa-cloud text-xs"></i>
    <span>Digital</span>
  </div>

  <!-- Image -->
  <div class="img-wrapper">
    <img src="<?php echo $p['img']; ?>" alt="<?php echo $p['name']; ?>" loading="lazy" />
    <div class="img-overlay"></div>
  </div>

  <!-- Body -->
  <div class="card-body">
    <div class="seller-tag">
      <i class="fas fa-store mr-1"></i>Cahyo SR
    </div>
    <p class="product-name"><?php echo $p['name']; ?></p>
  </div>

  <input type="hidden" name="nomor" value="<?php echo $p['nomor']; ?>" />
  <input type="hidden" name="subdo" value="<?php echo generateRandomSubdomain(); ?>" />
  <input type="hidden" name="trigger_alpha_92" value="1" />

  <button type="submit" class="btn-buat btn-<?php echo $p['btn']; ?>">
    <i class="fas fa-hammer mr-1"></i> BUAT WEB
  </button>
</form>

<?php endforeach; ?>

  </div><!-- /grid -->

  <!-- Empty state -->
  <div id="empty-state" class="hidden flex-col items-center justify-center py-16 text-center">
    <div class="w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center mb-4">
      <i class="fas fa-search text-gray-600 text-2xl"></i>
    </div>
    <p class="text-gray-500 font-medium">Template tidak ditemukan</p>
    <p class="text-gray-600 text-sm mt-1">Coba kata kunci lain</p>
  </div>
</main>

<!-- Floating Order Script Button -->
<a href="https://wa.me/6283896211964?text=Halo%20kak%20Cahyo%20SR%2C%20saya%20mau%20order%20script%20dong!"
   target="_blank"
   class="fab-order">
  <i class="fab fa-whatsapp text-lg"></i>
  <span>Order Script</span>
</a>

<!-- Toast -->
<div class="toast" id="toast"></div>

<script>
  // Count cards
  const allCards = document.querySelectorAll('.product-card');
  document.getElementById('card-count').textContent = allCards.length + ' template';

  // Show modal on load
  window.addEventListener('load', () => {
    const wrap = document.getElementById('info-message');
    const inner = document.getElementById('modal-inner');
    wrap.classList.remove('hidden');
    requestAnimationFrame(() => {
      inner.style.opacity = '1';
      inner.style.transform = 'scale(1)';
    });
  });

  function closeInfo() {
    const wrap = document.getElementById('info-message');
    const inner = document.getElementById('modal-inner');
    inner.style.opacity = '0';
    inner.style.transform = 'scale(0.95)';
    setTimeout(() => wrap.classList.add('hidden'), 350);
  }

  // Search filter
  function filterCards(query) {
    const q = query.toLowerCase().trim();
    let visible = 0;
    allCards.forEach(card => {
      const name = card.dataset.name || '';
      const match = name.includes(q);
      card.style.display = match ? '' : 'none';
      if (match) visible++;
    });
    document.getElementById('card-count').textContent = visible + ' template';
    const empty = document.getElementById('empty-state');
    if (visible === 0) {
      empty.classList.remove('hidden');
      empty.classList.add('flex');
    } else {
      empty.classList.add('hidden');
      empty.classList.remove('flex');
    }
  }

  // Toast on form submit
  document.querySelectorAll('.product-card').forEach(form => {
    form.addEventListener('submit', (e) => {
      const name = form.querySelector('.product-name')?.textContent || 'Template';
      showToast('⚡ Membuat web: ' + name + '...');
    });
  });

  function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
  }

  // Intersection Observer for card animation on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animationPlayState = 'running';
      }
    });
  }, { threshold: 0.1 });

  allCards.forEach(card => {
    card.style.animationPlayState = 'paused';
    observer.observe(card);
  });
</script>

</body>
</html>
