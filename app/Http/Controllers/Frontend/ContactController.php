<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        Message::create($validated);

        // Send email
        try {
            Mail::to(config('mail.from.address'))->send(new ContactMessage($validated));
            return redirect()->back()->with('success', __('تم إرسال رسالتك بنجاح، شكراً لتواصلك معنا!'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('تم إرسال رسالتك بنجاح، شكراً لتواصلك معنا!'));
        }
    }
}