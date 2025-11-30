<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>رسالة جديدة من الموقع</title>
    <style>
        body { font-family: Arial, sans-serif; direction: rtl; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; text-align: center; }
        .content { background: white; padding: 20px; border: 1px solid #dee2e6; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #495057; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>رسالة جديدة من موقعك</h2>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">الاسم:</span>
                <span>{{ $name }}</span>
            </div>
            <div class="field">
                <span class="label">البريد الإلكتروني:</span>
                <span>{{ $email }}</span>
            </div>
            <div class="field">
                <span class="label">الموضوع:</span>
                <span>{{ $subject }}</span>
            </div>
            <div class="field">
                <span class="label">الرسالة:</span>
                <div style="margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                    {{ $message }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>