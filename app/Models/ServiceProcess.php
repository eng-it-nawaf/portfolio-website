<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProcess extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'title',
        'description',
        'details',
        'duration',
        'requires_approval',
        'deliverables',
        'order',
    ];

    protected $casts = [
        'details' => 'array',
        'deliverables' => 'array',
        'requires_approval' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
