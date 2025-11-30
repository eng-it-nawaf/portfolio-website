<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'subject',
        'message',
        'is_read'
    ];

    protected $attributes = [
        'is_read' => false
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];
}