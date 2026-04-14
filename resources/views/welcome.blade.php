<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Pengumuman Kelulusan</title>
    <meta name="description" content="Portal informasi kelulusan siswa tingkat SMP berbasis Nomor Induk Siswa Nasional (NISN).">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Confetti JS untuk efek Lulus -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-color: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --card-bg: rgba(30, 41, 59, 0.7);
            
            --success-bg: rgba(20, 83, 45, 0.4);
            --success-text: #4ade80;
            --danger-bg: rgba(127, 29, 29, 0.4);
            --danger-text: #f87171;
            --warning-bg: rgba(113, 63, 18, 0.4);
            --warning-text: #facc15;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 24px;
            overflow-x: hidden;
            /* Latar belakang dinamis keren */
            background: radial-gradient(circle at 50% -20%, #1e1b4b, #0f172a 70%);
        }

        /* Animasi Background Particles Desktop */
        .bg-particles {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: -1;
            background-image: 
                radial-gradient(circle at 20% 40%, rgba(99, 102, 241, 0.15) 0%, transparent 25%),
                radial-gradient(circle at 80% 60%, rgba(236, 72, 153, 0.12) 0%, transparent 25%);
            animation: breathe 10s ease-in-out infinite alternate;
        }

        @keyframes breathe {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.15); opacity: 1; }
        }

        .container {
            width: 100%;
            max-width: 440px;
            z-index: 10;
        }

        .card {
            background: var(--card-bg);
            border-radius: 32px;
            padding: 44px 32px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            text-align: center;
            position: relative;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.08);
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .icon-wrapper {
            width: 86px;
            height: 86px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px auto;
            animation: floatIcon 4s ease-in-out infinite;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-8px) rotate(4deg); }
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 12px;
            background: linear-gradient(to right, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.01em;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 15px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 24px;
            text-align: left;
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px;
            border-radius: 16px;
            border: 2px solid rgba(255,255,255,0.05);
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            background-color: rgba(15, 23, 42, 0.6);
            color: #ffffff;
            font-weight: 600;
            letter-spacing: 2px;
            text-align: center;
        }

        .form-control::placeholder {
            color: #475569;
            font-weight: 400;
            letter-spacing: normal;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
            background-color: rgba(15, 23, 42, 0.9);
            transform: translateY(-2px);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: linear-gradient(to right, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.6);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.25), transparent);
            transform: skewX(-20deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            20% { left: 200%; }
            100% { left: 200%; }
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px -6px rgba(99, 102, 241, 0.8);
        }
        
        .btn-submit:active { transform: translateY(0); }

        /* Result States */
        .result-box {
            padding: 32px 24px;
            border-radius: 24px;
            animation: popIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: scale(0.9) translateY(20px);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .result-lulus {
            background-color: var(--success-bg);
            box-shadow: 0 10px 40px -10px rgba(34, 197, 94, 0.3);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }
        .result-lulus .status-badge { background-color: rgba(34, 197, 94, 0.2); color: var(--success-text); border: 1px solid var(--success-text); }
        .result-lulus h2 { color: var(--success-text); text-shadow: 0 0 20px rgba(34,197,94,0.4); }

        .result-gagal {
            background-color: var(--danger-bg);
            box-shadow: 0 10px 40px -10px rgba(239, 68, 68, 0.3);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }
        .result-gagal .status-badge { background-color: rgba(239, 68, 68, 0.2); color: var(--danger-text); border: 1px solid var(--danger-text); }
        .result-gagal h2 { color: var(--danger-text); text-shadow: 0 0 20px rgba(239,68,68,0.4); }

        .result-tunda {
            background-color: var(--warning-bg);
            box-shadow: 0 10px 40px -10px rgba(234, 179, 8, 0.3);
            border: 1px solid rgba(234, 179, 8, 0.2);
        }
        .result-tunda .status-badge { background-color: rgba(234, 179, 8, 0.2); color: var(--warning-text); border: 1px solid var(--warning-text); }
        .result-tunda h2 { color: var(--warning-text); text-shadow: 0 0 20px rgba(234,179,8,0.4); }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 20px;
        }

        .result-box h2 {
            font-size: 28px;
            margin-bottom: 12px;
            font-weight: 800;
        }

        .result-box p {
            color: #e2e8f0;
            font-size: 15px;
            line-height: 1.6;
        }

        .student-name {
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 24px;
            display: block;
            color: #ffffff;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 16px;
        }

        .error-msg {
            color: #fca5a5;
            font-size: 13px;
            margin-top: 10px;
            text-align: center;
            display: block;
            font-weight: 500;
            background: rgba(239,68,68,0.15);
            padding: 10px;
            border-radius: 10px;
            border: 1px solid rgba(239,68,68,0.3);
            animation: shake 0.4s;
        }

        /* Animations */
        @keyframes popIn {
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 24px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            padding: 12px 20px;
            border-radius: 14px;
            background: rgba(255,255,255,0.05);
        }
        .back-link:hover { 
            color: #fff; 
            background: rgba(255,255,255,0.1);
            transform: translateX(-4px);
        }
        
        .time-box {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 12px 10px;
            width: 70px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .time-box span {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
        }
        .time-box small {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* Spesifik HP Responsive 📱 */
        @media (max-width: 480px) {
            body { padding: 16px; }
            .card { padding: 32px 20px; border-radius: 24px; }
            .icon-wrapper { width: 54px; height: 54px; margin-bottom: 20px;}
            h1 { font-size: 24px; }
            p.subtitle { font-size: 14px; margin-bottom: 24px; }
            .form-control { padding: 14px 16px; font-size: 16px; }
            .btn-submit { padding: 15px; font-size: 15px; }
            .result-box { padding: 24px 20px; }
            .result-box h2 { font-size: 24px; }
            .student-name { font-size: 20px; }
        }
    </style>
</head>
<body>
    <div class="bg-particles"></div>

    <main class="container">
        <div class="card">
            
            @if(!isset($searched))
            <div class="icon-wrapper">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXLt5bAv6v_c19WcwULt5bhtpa7zoKS0swmQ&s" alt="Logo Tut Wuri Handayani" style="width: 100%; height: auto; filter: drop-shadow(0px 8px 16px rgba(0,0,0,0.5)); border-radius: 50%;">
            </div>
            
            <h1>SMP Negeri 1 Merbau</h1>
            <p class="subtitle">Silakan ketik 10 digit NISN Anda untuk melihat hasil kelulusan tahun ajaran ini.</p>

            @if(!empty($announcement_time) && \Carbon\Carbon::parse($announcement_time)->isFuture())
                <div id="countdown-wrapper" style="margin: 30px 0;">
                    <div style="font-size: 13px; text-transform: uppercase; letter-spacing: 2px; color: var(--text-muted); margin-bottom: 20px; font-weight: 600;">Waktu Tersisa Menuju Pengumuman</div>
                    <div style="display: flex; justify-content: center; gap: 12px;">
                        <div class="time-box"><span id="days">00</span><small>HARI</small></div>
                        <div class="time-box"><span id="hours">00</span><small>JAM</small></div>
                        <div class="time-box"><span id="minutes">00</span><small>MNT</small></div>
                        <div class="time-box"><span id="seconds">00</span><small>DTK</small></div>
                    </div>
                </div>
                <script>
                    var countDownDate = new Date("{{ \Carbon\Carbon::parse($announcement_time)->toIso8601String() }}").getTime();
                    var x = setInterval(function() {
                        var distance = countDownDate - new Date().getTime();
                        if (distance < 0) {
                            clearInterval(x);
                            window.location.reload();
                        } else {
                            document.getElementById("days").innerText = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                            document.getElementById("hours").innerText = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                            document.getElementById("minutes").innerText = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                            document.getElementById("seconds").innerText = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
                        }
                    }, 1000);
                </script>
            @else
                <form action="{{ route('check') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" inputmode="numeric" id="nisn-input" name="nisn" class="form-control" placeholder="Nomor NISN Anda" value="{{ old('nisn') }}" required autocomplete="off" autofocus>
                        @error('nisn')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit">
                        <span style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                            Cari Data Kelulusan
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </span>
                    </button>
                </form>
            @endif
            @endif

            @if(isset($searched))
                @if($student)
                    @php
                        $statusClass = 'result-gagal';
                        if($student->status === 'Lulus') $statusClass = 'result-lulus';
                        if($student->status === 'Ditunda') $statusClass = 'result-tunda';
                    @endphp
                    <div class="result-box {{ $statusClass }}">
                        <span class="status-badge">{{ $student->status }}</span>
                        <span class="student-name">{{ $student->name }}</span>
                        <h2>
                            @if($student->status === 'Lulus') Selamat! 🎉
                            @elseif($student->status === 'Tidak Lulus') Mohon Maaf,
                            @else Perhatian
                            @endif
                        </h2>
                        <p>{{ $student->message }}</p>
                    </div>

                    @if($student->status === 'Lulus')
                    <!-- Script Ledakan Confetti! 🎉 -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var duration = 4 * 1000;
                            var end = Date.now() + duration;

                            (function frame() {
                                confetti({ particleCount: 6, angle: 60, spread: 55, origin: { x: 0 }, colors: ['#4ade80', '#e879f9', '#facc15'] });
                                confetti({ particleCount: 6, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#4ade80', '#e879f9', '#facc15'] });
                                if (Date.now() < end) requestAnimationFrame(frame);
                            }());
                        });
                    </script>
                    @endif

                @else
                    <div class="result-box result-gagal" style="margin-top: 0;">
                        <span class="status-badge">Tidak Ditemukan</span>
                        <h2>Data Tidak Ada</h2>
                        <p>Pastikan NISN yang dimasukkan sudah benar. Hubungi pihak Tata Usaha jika data tidak sesuai.</p>
                    </div>
                @endif
                <a href="{{ route('home') }}" class="back-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path d="m15 18-6-6 6-6"/></svg>
                    Cek NISN Lainnya
                </a>
            @endif

        </div>
    </main>

</body>
</html>
