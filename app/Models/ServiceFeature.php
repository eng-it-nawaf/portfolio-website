<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFeature extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'title',
        'description',
        'icon',
        'items',
        'is_highlighted',
        'order',
    ];

    protected $casts = [
        'items' => 'array',
        'is_highlighted' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
