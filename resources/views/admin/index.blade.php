<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Info Kelulusan</title>
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

        /* Navbar */
        .navbar {
            background: var(--bg-card);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-brand { font-size: 20px; font-weight: 700; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; gap: 20px; align-items: center; }
        
        .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary);
            background: rgba(79, 70, 229, 0.08);
        }

        .container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

        .card {
            background: var(--bg-card);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 24px;
            border: 1px solid var(--border-color);
        }

        .card-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);
        }

        .card-header h2 { font-size: 22px; font-weight: 700; }

        .btn {
            font-family: 'Outfit', sans-serif;
            padding: 10px 20px; border-radius: 10px; border: none; font-size: 14px;
            font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-outline { background: white; border: 1px solid var(--border-color); color: var(--text-main); }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary); }
        .btn-danger { background: #fee2e2; color: #dc2626; padding: 6px 12px; font-size: 12px; }
        .btn-warning { background: #fef3c7; color: #d97706; padding: 6px 12px; font-size: 12px; }
        .btn-success { background: #10b981; color: white; }

        /* Upload Section */
        .upload-area {
            background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 16px;
            padding: 24px; text-align: center; transition: all 0.3s;
            margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;
        }
        .upload-area:hover { border-color: var(--primary); background: #f1f5f9; }
        
        input[type="file"] {
            border: 1px solid #cbd5e1; padding: 8px; border-radius: 8px; background: white; margin-right: 12px; font-size: 14px;
        }

        /* Table */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: separate; border-spacing: 0; }
        th { background: #f8fafc; padding: 16px; text-align: left; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); font-weight: 600; border-bottom: 1px solid var(--border-color); }
        td { padding: 16px; border-bottom: 1px solid #f1f5f9; font-size: 15px; vertical-align: middle;}
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-block;}
        .b-lulus { background: #dcfce7; color: #166534; }
        .b-gagal { background: #fee2e2; color: #991b1b; }
        .b-tunda { background: #fef9c3; color: #854d0e; }

        .alert { background: #dcfce7; color: #166534; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500; display: flex; align-items: center; gap: 10px; border: 1px solid #bbf7d0;}
        .alert-error { background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 12px; margin-bottom: 24px; font-weight: 500; display: flex; align-items: center; gap: 10px; border: 1px solid #fecaca;}
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            Panel Admin
        </div>
        <div class="nav-links">
            <a href="{{ route('admin.index') }}" class="nav-link active">Data Siswa</a>
            <a href="{{ route('admin.settings') }}" class="nav-link">Pengaturan</a>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">Lihat Web</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline" style="padding: 6px 12px;">Logout</button>
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
        @if(session('error'))
            <div class="alert-error">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="upload-area">
                <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data" style="display:flex; align-items:center;">
                    @csrf
                    <div>
                        <h4 style="margin: 0 0 8px 0; color:var(--text-main); font-size:16px;">Impor Data Massal Cepat</h4>
                        <p style="color:var(--text-muted); font-size:13px; margin-bottom: 12px;">Format harus berupa .CSV (Dipisahkan koma/titik-koma)</p>
                        <input type="file" name="file" accept=".csv" required>
                        <button type="submit" class="btn btn-success">Mulai Import</button>
                    </div>
                </form>
                <div>
                    <a href="{{ route('admin.template') }}" class="btn btn-outline">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Download Template CSV
                    </a>
                </div>
            </div>

            <div class="card-header">
                <h2>Daftar Siswa Kelulusan</h2>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Tambah Manual</a>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Status Kelulusan</th>
                            <th>Pesan Khusus</th>
                            <th width="140">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $s)
                        <tr>
                            <td style="font-weight:700; letter-spacing:1px; color:var(--text-main);">{{ $s->nisn }}</td>
                            <td style="font-weight:500;">{{ $s->name }}</td>
                            <td>
                                <span class="badge @if($s->status == 'Lulus') b-lulus @elseif($s->status == 'Tidak Lulus') b-gagal @else b-tunda @endif">
                                    {{ $s->status }}
                                </span>
                            </td>
                            <td style="color: var(--text-muted); font-size: 14px;">{{ \Illuminate\Support\Str::limit($s->message, 30) }}</td>
                            <td>
                                <div style="display:flex; gap:8px;">
                                    <a href="{{ route('admin.edit', $s->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Hapus siswa ini secara permanen?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding: 40px; color: var(--text-muted);">Belum ada data siswa. Silakan import dari CSV.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
