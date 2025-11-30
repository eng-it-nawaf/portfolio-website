<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        // استخدم paginate بدلاً من get للحصول على Paginator object
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        // تحديث حالة الرسالة كمقروءة
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        $message->update(['is_read' => true]);
        
        return back()->with('success', 'تم تعيين الرسالة كمقروءة');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        
        return redirect()->route('admin.messages.index')
            ->with('success', 'تم حذف الرسالة بنجاح');
    }
}