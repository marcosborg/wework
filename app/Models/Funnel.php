<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Funnel extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'funnels';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'description_2',
        'category_id',
        'file',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    public function firstStep()
    {
        return $this->hasMany(Step::class)->limit(1);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function funnelSteps()
    {
        return $this->hasMany(Step::class, 'funnel_id', 'id');
    }

    public function funnelsCompanies()
    {
        return $this->belongsToMany(Company::class);
    }
}