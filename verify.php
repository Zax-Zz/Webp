<?php
function gcodeGenerateSession($length = 5) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $token = '';
    $maxRandIndex = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[random_int(0, $maxRandIndex)];
    }

    return $token;
}

function saveSessionToken($token) {
    $_SESSION['secToken'] = $token;
}

function getSessionToken() {
    if (isset($_SESSION['secToken'])) {
        return $_SESSION['secToken'];
    }
    return null;
}

function validateSessionToken($token) {
    if ($token === getSessionToken()) {
        return true;
    }
    return false;
}

session_start();
if (!isset($_SESSION['userAgent']) || $_SESSION['userAgent'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_regenerate_id(true);
    $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
}

if (!isset($_SESSION['secToken'])) {
    $securityToken = gcodeGenerateSession(5);
    saveSessionToken($securityToken);
} else {
    $securityToken = getSessionToken();
}

if (isset($_POST['gcodeToken'])) {
    $gcodeToken = $_POST['gcodeToken'];

    if (validateSessionToken($gcodeToken)) {
        echo "<form id='gcodeSub' method='POST' action='index.php?gToken=verified'>
        <input type='hidden' name='sessionToken' value='well'>
        </form>
        <script type='text/javascript'>document.getElementById('gcodeSub').submit();</script>";
    } else {
        echo "<script>alert('Sandi yang Anda masukkan salah!'); window.location='verify.php';</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify to Continue</title>
    <meta author="G-Code | www.g-code.co.id">
    <meta property="og:title" content=" ">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co.com/0yhbpy7/No-robots-allowed.jpg">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --success: #22c55e;
            --success-glow: rgba(34, 197, 94, 0.3);
            --bg: #0f0f1a;
            --card: #16162a;
            --card-border: rgba(99, 102, 241, 0.2);
            --text: #e2e8f0;
            --muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Animated background ── */
        .bg-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMove {
            0%   { transform: translateY(0); }
            100% { transform: translateY(40px); }
        }

        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            animation: orbFloat 8s ease-in-out infinite;
        }

        .orb-1 {
            width: 400px; height: 400px;
            background: rgba(99, 102, 241, 0.15);
            top: -100px; left: -100px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 300px; height: 300px;
            background: rgba(139, 92, 246, 0.1);
            bottom: -80px; right: -80px;
            animation-delay: 3s;
        }

        .orb-3 {
            width: 200px; height: 200px;
            background: rgba(59, 130, 246, 0.08);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 5s;
        }

        @keyframes orbFloat {
            0%, 100% { transform: translateY(0) scale(1); }
            50%       { transform: translateY(-20px) scale(1.05); }
        }

        /* ── Floating particles ── */
        .particles {
            position: fixed;
            inset: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 3px; height: 3px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0;
            animation: particleFly linear infinite;
        }

        @keyframes particleFly {
            0%   { opacity: 0; transform: translateY(100vh) scale(0); }
            10%  { opacity: 0.6; }
            90%  { opacity: 0.3; }
            100% { opacity: 0; transform: translateY(-20px) scale(1.5); }
        }

        /* ── Card ── */
        .card {
            position: relative;
            background: var(--card);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px 36px;
            width: 420px;
            max-width: 95vw;
            text-align: center;
            box-shadow:
                0 0 0 1px rgba(99,102,241,0.1),
                0 25px 50px rgba(0,0,0,0.5),
                0 0 80px rgba(99,102,241,0.05);
            animation: cardIn 0.6s cubic-bezier(0.34,1.56,0.64,1) both;
            overflow: hidden;
        }

        @keyframes cardIn {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary), #a78bfa, transparent);
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0%   { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* ── Icon header ── */
        .icon-wrap {
            width: 72px; height: 72px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(139,92,246,0.2));
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            animation: iconPulse 3s ease-in-out infinite;
            position: relative;
        }

        .icon-wrap::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary), #a78bfa);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }

        @keyframes iconPulse {
            0%, 100% { box-shadow: 0 0 0 0 var(--primary-glow); }
            50%       { box-shadow: 0 0 0 12px transparent; }
        }

        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .card-sub {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 30px;
        }

        /* ── Checkbox row ── */
        #checkContainer {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 20px;
            border-radius: 14px;
            border: 1.5px solid rgba(99,102,241,0.2);
            background: rgba(99,102,241,0.04);
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
        }

        #checkContainer::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(99,102,241,0.08), transparent);
            transform: translateX(-100%);
            transition: transform 0s;
        }

        #checkContainer:hover {
            border-color: rgba(99,102,241,0.5);
            background: rgba(99,102,241,0.08);
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(99,102,241,0.15);
        }

        #checkContainer.verified {
            border-color: rgba(34,197,94,0.4);
            background: rgba(34,197,94,0.06);
            box-shadow: 0 4px 20px rgba(34,197,94,0.1);
        }

        /* ── Custom checkbox icon ── */
        .check-icon-wrap {
            width: 36px; height: 36px;
            flex-shrink: 0;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #CheckBox svg, #LoadSpinner svg, #CheckMark svg {
            width: 28px; height: 28px;
            transition: all 0.3s;
        }

        .check-label {
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            flex: 1;
            text-align: left;
        }

        .check-badge {
            font-size: 10px;
            color: var(--muted);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* ── Spinner ── */
        .spinner-ring {
            width: 28px; height: 28px;
            border: 2.5px solid rgba(99,102,241,0.2);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* ── Checkmark SVG animation ── */
        .checkmark-circle {
            stroke: var(--success);
            stroke-width: 2;
            fill: none;
            stroke-dasharray: 76;
            stroke-dashoffset: 76;
            animation: drawCircle 0.5s ease forwards;
        }

        .checkmark-tick {
            stroke: var(--success);
            stroke-width: 2.5;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 30;
            stroke-dashoffset: 30;
            animation: drawTick 0.4s ease 0.4s forwards;
        }

        @keyframes drawCircle {
            to { stroke-dashoffset: 0; }
        }

        @keyframes drawTick {
            to { stroke-dashoffset: 0; }
        }

        /* ── Button ── */
        #btnVerify {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        #btnVerify::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        #btnVerify:not(:disabled):hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99,102,241,0.5);
        }

        #btnVerify:not(:disabled):hover::after {
            opacity: 1;
        }

        #btnVerify:not(:disabled):active {
            transform: translateY(0);
        }

        #btnVerify:disabled {
            opacity: 0.35;
            cursor: not-allowed;
            filter: grayscale(0.3);
        }

        .btn-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* ── Footer ── */
        .footer-row {
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--muted);
            font-size: 12px;
        }

        .footer-row a {
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-row a:hover {
            color: var(--primary);
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: rgba(100,116,139,0.6);
        }

        .brand-dot {
            width: 5px; height: 5px;
            background: var(--primary);
            border-radius: 50%;
            animation: blinkDot 2s ease-in-out infinite;
        }

        @keyframes blinkDot {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.3; }
        }

        /* ── Ripple ── */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(99,102,241,0.3);
            transform: scale(0);
            animation: rippleOut 0.6s ease-out forwards;
            pointer-events: none;
        }

        @keyframes rippleOut {
            to { transform: scale(4); opacity: 0; }
        }

        /* ── Success glow on card ── */
        .card.success-glow {
            box-shadow:
                0 0 0 1px rgba(34,197,94,0.2),
                0 25px 50px rgba(0,0,0,0.5),
                0 0 80px rgba(34,197,94,0.1);
        }

        /* hidden */
        .hidden { display: none !important; }
    </style>
</head>
<body>

    <!-- Background layers -->
    <div class="bg-grid"></div>
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-orb orb-3"></div>
    <div class="particles" id="particles"></div>

    <!-- Card -->
    <div class="card" id="mainCard">
        <!-- Header icon -->
        <div class="icon-wrap">🛡️</div>
        <h1 class="card-title">Verifikasi Sebelum Masuk</h1>
        <p class="card-sub">Please verify that you're a human to continue</p>

        <form method="POST" id="verifyForm">
            <!-- Checkbox row -->
            <div id="checkContainer">
                <input id="myCheckbox" type="checkbox" class="hidden" required>
                <div class="check-icon-wrap">
                    <!-- Default square -->
                    <div id="CheckBox">
                        <svg viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="5" stroke="#475569" stroke-width="2"/>
                        </svg>
                    </div>
                    <!-- Spinner -->
                    <div id="LoadSpinner" class="hidden">
                        <div class="spinner-ring"></div>
                    </div>
                    <!-- Animated checkmark -->
                    <div id="CheckMark" class="hidden">
                        <svg viewBox="0 0 28 28">
                            <circle class="checkmark-circle" cx="14" cy="14" r="11"/>
                            <path class="checkmark-tick" d="M8.5 14l4 4 7-8"/>
                        </svg>
                    </div>
                </div>
                <span class="check-label">I'm not a robot</span>
                <span class="check-badge">reCAPTCHA</span>
            </div>

            <input type="hidden" name="gcodeToken" value="<?= htmlspecialchars($_SESSION['secToken']); ?>">

            <button type="submit" id="btnVerify" disabled>
                <span class="btn-content">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Continue
                </span>
            </button>
        </form>

        <div class="footer-row">
            <div>
                <a href="#">Privacy</a>
                <span style="margin: 0 6px; opacity:0.4">•</span>
                <a href="#">Terms</a>
            </div>
            <div class="footer-brand">
                <div class="brand-dot"></div>
                G-Code Security
            </div>
        </div>
    </div>

    <script>
        // ── Particles generator ──
        const particleContainer = document.getElementById('particles');
        const PARTICLE_COUNT = 25;

        for (let i = 0; i < PARTICLE_COUNT; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.style.cssText = `
                left: ${Math.random() * 100}%;
                width: ${Math.random() * 3 + 1}px;
                height: ${Math.random() * 3 + 1}px;
                animation-duration: ${Math.random() * 15 + 10}s;
                animation-delay: ${Math.random() * 10}s;
                opacity: 0;
            `;
            particleContainer.appendChild(p);
        }

        // ── Checkbox logic ──
        const myCheckbox    = document.getElementById('myCheckbox');
        const btnVerify     = document.getElementById('btnVerify');
        const checkContainer = document.getElementById('checkContainer');
        const CheckBox      = document.getElementById('CheckBox');
        const LoadSpinner   = document.getElementById('LoadSpinner');
        const CheckMark     = document.getElementById('CheckMark');
        const mainCard      = document.getElementById('mainCard');

        checkContainer.addEventListener('click', function(e) {
            if (myCheckbox.checked) return;

            // Ripple effect
            const rect = checkContainer.getBoundingClientRect();
            const ripple = document.createElement('div');
            ripple.className = 'ripple';
            ripple.style.width  = ripple.style.height = '60px';
            ripple.style.left   = (e.clientX - rect.left - 30) + 'px';
            ripple.style.top    = (e.clientY - rect.top  - 30) + 'px';
            checkContainer.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);

            // Show spinner
            CheckBox.classList.add('hidden');
            LoadSpinner.classList.remove('hidden');

            setTimeout(function() {
                // Show animated checkmark
                LoadSpinner.classList.add('hidden');
                CheckMark.classList.remove('hidden');
                myCheckbox.checked = true;
                btnVerify.disabled = false;
                checkContainer.classList.add('verified');
                mainCard.classList.add('success-glow');
            }, 1000);
        });

        // ── Button ripple ──
        btnVerify.addEventListener('click', function(e) {
            if (btnVerify.disabled) return;
            const rect = btnVerify.getBoundingClientRect();
            const ripple = document.createElement('div');
            ripple.className = 'ripple';
            ripple.style.cssText = `
                width: 60px; height: 60px;
                left: ${e.clientX - rect.left - 30}px;
                top: ${e.clientY - rect.top - 30}px;
                background: rgba(255,255,255,0.25);
            `;
            btnVerify.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    </script>
</body>
</html>
