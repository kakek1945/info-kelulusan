<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; padding: 40px 20px; color: #0f172a; margin: 0; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 20px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #f1f5f9; }
        th { background: #f8fafc; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; }
        .btn { padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; display: inline-block; cursor:pointer; font-weight: 500; border: none;}
        .btn-primary { background: #4f46e5; color: white; }
        .btn-success { background: #10b981; color: white; }
        .btn-warning { background: #f59e0b; color: white; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-outline { border: 1px solid #cbd5e1; background: white; color: #334155; }
        .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .b-lulus { background: #dcfce7; color: #166534; }
        .b-gagal { background: #fee2e2; color: #991b1b; }
        .b-tunda { background: #fef9c3; color: #854d0e; }
        .alert { background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;}
        .alert-error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;}
        .upload-box { background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 12px; padding: 20px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; }
        .upload-input { font-size: 14px; border: 1px solid #e2e8f0; background: white; padding: 6px; border-radius: 6px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Daftar Siswa</h2>
            <div>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
                <a href="{{ route('home') }}" class="btn" style="background:#f1f5f9; margin-left:10px; color: #333;">Lihat Web</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn" style="background:#e2e8f0; margin-left:10px; color: #333;">Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <div class="upload-box">
            <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data" style="display:flex; align-items:center; gap:12px;">
                @csrf
                <div>
                    <h4 style="margin: 0 0 8px 0; color:#334155;">Upload Data Massal (Format CSV)</h4>
                    <input type="file" name="file" class="upload-input" accept=".csv" required>
                    <button type="submit" class="btn btn-success">Import Excel/CSV</button>
                </div>
            </form>
            <div>
                <a href="{{ route('admin.template') }}" class="btn btn-outline" style="font-size: 13px;">&#8595; Download Template Excel (CSV)</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $s)
                <tr>
                    <td style="font-weight:600;">{{ $s->nisn }}</td>
                    <td>{{ $s->name }}</td>
                    <td>
                        <span class="badge @if($s->status == 'Lulus') b-lulus @elseif($s->status == 'Tidak Lulus') b-gagal @else b-tunda @endif">
                            {{ $s->status }}
                        </span>
                    </td>
                    <td style="color: #64748b; font-size: 14px;">{{ \Illuminate\Support\Str::limit($s->message, 40) }}</td>
                    <td>
                        <a href="{{ route('admin.edit', $s->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.destroy', $s->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding: 30px; color: #94a3b8;">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
