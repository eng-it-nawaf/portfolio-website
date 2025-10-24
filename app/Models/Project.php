<?php
// app/Models/Project.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'technologies', 
        'category', 'github_url', 'demo_url',
        'play_store_url', 'completed_at', 'order'
    ];

    protected $casts = [
    'completed_at' => 'date',
];

    protected $appends = ['images_count'];

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    public function getImagesCountAttribute()
    {
        return $this->images()->count();
    }

        public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}