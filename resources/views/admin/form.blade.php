<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; padding: 40px 20px; }
        .container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px;}
        input, select, textarea { width: 100%; padding: 14px; border: 1px solid #cbd5e1; border-radius: 10px; box-sizing: border-box; font-family:inherit;}
        input:focus, select:focus, textarea:focus { border-color: #4f46e5; outline: none; }
        .btn { padding: 14px 20px; background: #4f46e5; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: 600; width: 100%;}
        .text-danger { color: #dc2626; font-size: 13px; margin-top:6px; display:block;}
    </style>
</head>
<body>
    <div class="container">
        <h2 style="margin-top:0; margin-bottom: 24px;">{{ isset($student) ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}</h2>
        <form action="{{ isset($student) ? route('admin.update', $student->id) : route('admin.store') }}" method="POST">
            @csrf
            @if(isset($student)) @method('PUT') @endif
            
            <div class="form-group">
                <label>NISN</label>
                <input type="text" name="nisn" value="{{ old('nisn', $student->nisn ?? '') }}" placeholder="Masukkan 10 digit NISN" required>
                @error('nisn') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap Siswa</label>
                <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" placeholder="Contoh: Budi Santoso" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label>Status Kelulusan</label>
                <select name="status" required>
                    <option value="Lulus" {{ old('status', $student->status ?? '') == 'Lulus' ? 'selected' : '' }}>Lulus</option>
                    <option value="Tidak Lulus" {{ old('status', $student->status ?? '') == 'Tidak Lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                    <option value="Ditunda" {{ old('status', $student->status ?? '') == 'Ditunda' ? 'selected' : '' }}>Ditunda</option>
                </select>
                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label>Pesan Khusus (Opsional)</label>
                <textarea name="message" rows="4" placeholder="Contoh: Selamat Anda Lulus! Silakan melengkapi berkas administrasi selanjutnya.">{{ old('message', $student->message ?? '') }}</textarea>
            </div>
            
            <div style="display:flex; gap:10px; margin-top:30px;">
                <a href="{{ route('admin.index') }}" class="btn" style="background:#e2e8f0; color:#333; text-decoration:none; text-align:center;">Batal</a>
                <button type="submit" class="btn">Simpan Data</button>
            </div>
        </form>
    </div>
</body>
</html>
