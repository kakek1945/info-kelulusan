<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 400px; text-align: center; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 8px; font-weight: 600; font-size: 14px; }
        input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #4f46e5; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; }
        .error { color: #dc2626; font-size: 14px; margin-bottom: 16px; display: block; background: #fee2e2; padding: 10px; border-radius: 8px;}
    </style>
</head>
<body>
    <div class="login-card">
        <h2 style="margin-bottom: 24px;">Login Admin</h2>
        @if($errors->any())
            <span class="error">{{ $errors->first() }}</span>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Admin</label>
                <input type="email" name="email" placeholder="admin@admin.com" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="password123" required>
            </div>
            <button type="submit">Masuk Sistem</button>
        </form>
        <a href="{{ route('home') }}" style="display:block; margin-top:20px; color:#64748b; font-size:14px; text-decoration:none;">&larr; Kembali ke Pengecekan</a>
    </div>
</body>
</html>
