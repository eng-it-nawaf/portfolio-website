<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'technologies', 
        'category', 'github_url', 'demo_url',
        'play_store_url', 'completed_at', 'order', 'is_active'
    ];

    protected $casts = [
        'completed_at' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $appends = ['images_count', 'formatted_date'];

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    protected function getImagesCountAttribute(): int
    {
        return $this->images()->count();
    }

    protected function getFormattedDateAttribute(): string
    {
        return $this->completed_at ? $this->completed_at->format('d/m/Y') : 'غير محدد';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWeb($query)
    {
        return $query->where('category', 'web');
    }

    public function scopeMobile($query)
    {
        return $query->where('category', 'mobile');
    }

    public function scopeDesktop($query)
    {
        return $query->where('category', 'desktop');
    }

    public function getCategoryNameAttribute(): string
    {
        return match($this->category) {
            'web' => 'ويب',
            'mobile' => 'موبايل',
            'desktop' => 'سطح المكتب',
            default => 'غير محدد'
        };
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}