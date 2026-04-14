<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Admin - Info Kelulusan</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-body: #f1f5f9;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body { background: var(--bg-body); color: var(--text-main); line-height: 1.6; }

        /* Navbar sama dengan index */
        .navbar {
            background: var(--bg-card); padding: 16px 40px; display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 4px 20px rgba(0,0,0,0.03); position: sticky; top: 0; z-index: 50;
        }
        .navbar-brand { font-size: 20px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; gap: 20px; align-items: center; }
        .nav-link { color: var(--text-muted); text-decoration: none; font-weight: 500; padding: 8px 16px; border-radius: 8px; transition: all 0.2s; }
        .nav-link:hover, .nav-link.active { color: var(--primary); background: rgba(79, 70, 229, 0.08); }

        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .card {
            background: var(--bg-card); border-radius: 20px; padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02); border: 1px solid var(--border-color);
        }

        .card-header { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color); }
        .card-header h2 { font-size: 20px; font-weight: 700; display:flex; align-items:center; gap: 8px;}

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #334155; font-size: 14px;}
        .form-control {
            width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #cbd5e1;
            font-size: 15px; transition: border-color 0.2s; outline: none; font-family: 'Outfit', sans-serif;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        
        .btn {
            font-family: 'Outfit', sans-serif; padding: 12px 20px; border-radius: 10px; border: none; font-size: 15px;
            font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; width: 100%; text-align: center;
        }
        .btn-primary { background: var(--primary); color: white; transition: all 0.2s; }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }

        .alert { background: #dcfce7; color: #166534; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500; display: flex; align-items: center; gap: 10px; border: 1px solid #bbf7d0;}
        .error-msg { color: #dc2626; font-size: 13px; margin-top: 6px; display: block; font-weight: 500;}

        @media(max-width: 768px) {
            .dashboard-grid { grid-template-columns: 1fr; }
            .navbar { flex-direction: column; padding: 16px; gap: 16px; }
            .nav-links { flex-wrap: wrap; justify-content: center; }
            .card { padding: 20px; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            Panel Admin
        </div>
        <div class="nav-links">
            <a href="{{ route('admin.index') }}" class="nav-link">Data Siswa</a>
            <a href="{{ route('admin.settings') }}" class="nav-link active">Pengaturan</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="padding: 6px 12px; background: white; border: 1px solid #cbd5e1; color: #333;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="dashboard-grid">
            
            <!-- Timer Settings -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        Waktu Pengumuman (Timer)
                    </h2>
                </div>
                <form action="{{ route('admin.settings.timer') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Pilih Tanggal & Jam Buka Sistem</label>
                        <input type="datetime-local" class="form-control" name="announcement_time" value="{{ $announcement_time ? \Carbon\Carbon::parse($announcement_time)->format('Y-m-d\TH:i') : '' }}">
                        <small style="color: var(--text-muted); display: block; margin-top: 8px;">*Kosongkan waktu jika ingin sistem selalu terbuka (tanpa hitung mundur).</small>
                        @error('announcement_time') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Waktu</button>
                </form>
            </div>

            <!-- Security Settings -->
            <div class="card">
                <div class="card-header">
                    <h2>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        Keamanan Akun
                    </h2>
                </div>
                <form action="{{ route('admin.settings.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Password Saat Ini</label>
                        <input type="password" class="form-control" name="current_password" required>
                        @error('current_password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="password" required>
                        @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>
