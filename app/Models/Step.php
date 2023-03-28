<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Step extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'steps';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'funnel_id',
        'state_id',
        'sender',
        'notify_client',
        'template_client',
        'notify_company',
        'template_company',
        'notify_user',
        'template_user',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function stepItems()
    {
        return $this->hasMany(Item::class, 'step_id', 'id');
    }

    public function funnel()
    {
        return $this->belongsTo(Funnel::class, 'funnel_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }
}
