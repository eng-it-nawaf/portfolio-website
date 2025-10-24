<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'percentage', 'icon', 'category', 'order'];
    
    // قائمة الفئات المتاحة
    public static function categories(): array
    {
        return [
            'Programming Languages',
            'Web Development',
            'Frameworks',
            'Databases',
            'Operating Systems',
            'Networking',
            'Design & Tools'
        ];
    }
}