<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image_path', 'order'];
    
    protected $appends = ['image_url'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => asset('storage/' . $this->image_path)
        );
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->generateThumbnailUrl()
        );
    }

    private function generateThumbnailUrl(): string
    {
        $pathInfo = pathinfo($this->image_path);
        $thumbnailPath = $pathInfo['dirname'] . '/thumbs/' . $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];
        
        return Storage::disk('public')->exists($thumbnailPath) 
            ? asset('storage/' . $thumbnailPath)
            : $this->image_url;
    }
}