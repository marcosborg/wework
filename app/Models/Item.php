<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Item extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'items';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'step_id',
        'user_id',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function itemInputs()
    {
        return $this->hasMany(Input::class, 'item_id', 'id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function lastInput()
    {
        return $this->hasMany(Input::class, 'item_id', 'id')->orderBy('id', 'desc');
    }

    public function step()
    {
        return $this->belongsTo(Step::class, 'step_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }
}
