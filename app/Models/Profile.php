<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'about',
        'email',
        'phone',
        'address',
        'photo',
        'social_links',
        'whatsapp',
        'telegram',
        'facebook',
        'youtube',
        'instagram',
        'stackoverflow',
        'website'
    ];

    protected $casts = [
        'social_links' => 'array'
    ];
}