<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
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
        'is_featured',
        'is_active',
        'features',
        'process',
        'order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array',
        'process' => 'array'
    ];

    // القيم الافتراضية للميزات
protected $defaultFeature = [
    'title' => 'تصميم واجهة مستخدم عصرية',
    'description' => 'نقدم واجهات مستخدم حديثة وسهلة الاستخدام تضمن تجربة سلسة للمستخدم النهائي وتعزز جاذبية التطبيق.',
    'icon' => 'fas fa-mobile-alt',
    'items' => [
        'تصميم متجاوب مع مختلف الشاشات',
        'دراسة تجربة المستخدم (UX)',
        'تصميم باستخدام Figma أو Adobe XD'
    ],
    'is_highlighted' => true,
    'order' => 0
];


    // القيم الافتراضية لخطوات العملية
protected $defaultProcessStep = [
    'title' => 'تحليل المتطلبات وتحديد الأهداف',
    'description' => 'نبدأ بفهم فكرة التطبيق وتحليل السوق المستهدف لتحديد الأهداف الرئيسية وتفاصيل المتطلبات.',
    'details' => [
        'لقاء مع العميل لفهم الفكرة والأهداف',
        'تحليل المنافسين واحتياجات المستخدمين',
        'تحديد ميزات التطبيق الأساسية'
    ],
    'duration' => '2-3 أيام عمل',
    'order' => 0,
    'requires_approval' => true,
    'deliverables' => ['وثيقة تحليل المتطلبات', 'خارطة طريق المشروع']
];


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps();
    }

    public function getProcessAttribute($value)
    {
        $process = $this->castToArray($value);
        
        // إضافة قيم افتراضية لخطوات العملية
        return array_map(function($step) {
            if (!is_array($step)) {
                $step = [];
            }
            
            // دمج القيم الافتراضية مع القيم الموجودة
            $mergedStep = array_merge($this->defaultProcessStep, $step);
            
            // معالجة التفاصيل بشكل منفصل للتأكد من أنها مصفوفة
            if (isset($step['details']) && is_array($step['details'])) {
                $mergedStep['details'] = $step['details'];
            } else {
                $mergedStep['details'] = $this->defaultProcessStep['details'];
            }
            
            // معالجة المستلزمات بشكل منفصل
            if (isset($step['deliverables']) && is_array($step['deliverables'])) {
                $mergedStep['deliverables'] = $step['deliverables'];
            } else {
                $mergedStep['deliverables'] = $this->defaultProcessStep['deliverables'];
            }
            
            return $mergedStep;
        }, $process);
    }

    public function getFeaturesAttribute($value)
    {
        $features = $this->castToArray($value);
        
        // إضافة قيم افتراضية للميزات
        return array_map(function($feature) {
            if (!is_array($feature)) {
                $feature = [];
            }
            
            // دمج القيم الافتراضية مع القيم الموجودة
            $mergedFeature = array_merge($this->defaultFeature, $feature);
            
            // معالجة العناصر بشكل منفصل للتأكد من أنها مصفوفة
            if (isset($feature['items']) && is_array($feature['items'])) {
                $mergedFeature['items'] = $feature['items'];
            } else {
                $mergedFeature['items'] = $this->defaultFeature['items'];
            }
            
            return $mergedFeature;
        }, $features);
    }

    protected function castToArray($value)
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        return is_array($value) ? $value : [];
    }

    // دالة مساعدة للحصول على ملخص المميزات
    public function getFeaturesSummary($limit = 3, $maxLength = 100)
    {
        return collect($this->features)
            ->sortBy('order')
            ->take($limit)
            ->map(function($feature) use ($maxLength) {
                $description = $feature['description'] ?? '';
                return [
                    'title' => $feature['title'] ?? 'ميزة بدون عنوان',
                    'description' => Str::limit($description, $maxLength),
                    'icon' => $feature['icon'] ?? 'fas fa-check',
                    'is_highlighted' => $feature['is_highlighted'] ?? false
                ];
            })
            ->values()
            ->all();
    }

    // دالة مساعدة للحصول على خطوات العملية مرتبة
    public function getOrderedProcess()
    {
        return collect($this->process)
            ->sortBy('order')
            ->values()
            ->all();
    }

    // دالة مساعدة للحصول على الميزات المميزة
    public function getHighlightedFeatures()
    {
        return collect($this->features)
            ->where('is_highlighted', true)
            ->sortBy('order')
            ->values()
            ->all();
    }
}