<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('رسالة جديدة من الموقع: ' . $this->data['subject'])
                   ->view('emails.contact'); // تأكد أن هذا المسار يتطابق مع موقع الملف
    }
}