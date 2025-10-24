<!DOCTYPE html>
<html>
<head>
    <title>رسالة جديدة من موقعك</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #fff; }
        .footer { margin-top: 20px; padding: 10px; text-align: center; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>رسالة جديدة من موقعك</h2>
        </div>
        
        <div class="content">
            <p><strong>الاسم:</strong> {{ $data['name'] }}</p>
            <p><strong>البريد الإلكتروني:</strong> {{ $data['email'] }}</p>
            <p><strong>الموضوع:</strong> {{ $data['subject'] }}</p>
            <p><strong>الرسالة:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
        
        <div class="footer">
            تم إرسال هذه الرسالة تلقائياً من نظام الموقع
        </div>
    </div>
</body>
</html>