<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // حفظ في قاعدة البيانات
            $message = Message::create($validated);
            
            // تسجيل المعلومات للتصحيح
            Log::info('Message saved to database', [
                'id' => $message->id,
                'name' => $message->name,
                'email' => $message->email
            ]);

            // محاولة إرسال البريد الإلكتروني
            try {
                Mail::to(config('mail.from.address'))->send(new ContactMessage($validated));
                return redirect()->back()->with('success', __('تم إرسال رسالتك بنجاح، شكراً لتواصلك معنا!'));
            } catch (\Exception $e) {
                // إذا فشل إرسال البريد، لكن الرسالة حفظت في قاعدة البيانات
                Log::error('Email sending failed but message saved', [
                    'message_id' => $message->id,
                    'error' => $e->getMessage()
                ]);
                return redirect()->back()->with('success', __('تم إرسال رسالتك بنجاح، شكراً لتواصلك معنا!'));
            }

        } catch (\Exception $e) {
            // تسجيل الخطأ
            Log::error('Failed to save message to database', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return redirect()->back()->with('error', __('حدث خطأ أثناء إرسال الرسالة. يرجى المحاولة مرة أخرى.'));
        }
    }
}