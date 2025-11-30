<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
    <style>
        .login-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>مرحباً بعودتك</h1>
                <p>سجل الدخول إلى لوحة التحكم</p>
            </div>
            <div class="login-body">
                @if($errors->any())
                    <div class="alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <label style="display: flex; align-items: center; gap: 6px; font-size: 13px;">
                            <input type="checkbox" name="remember">
                            تذكرني
                        </label>
                        <a href="{{ route('password.request') }}" style="font-size: 13px; color: var(--primary-color); text-decoration: none;">
                            نسيت كلمة المرور؟
                        </a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                        تسجيل الدخول
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>