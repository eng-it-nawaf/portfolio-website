<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'icon',
        'image',
        'cover_image',
        'is_featured',
        'is_active',
        'order',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->slug = Str::slug($service->title);
        });

        static::updating(function ($service) {
            $service->slug = Str::slug($service->title);
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-service.jpg');
    }

    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ? Storage::url($this->cover_image) : asset('images/default-cover.jpg');
    }

    public function getExcerptAttribute($length = 150)
    {
        return Str::limit(strip_tags($this->description), $length);
    }

    // إضافة العلاقة مع المشاريع
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_service');
    }
}