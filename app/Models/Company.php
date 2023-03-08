<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public const THEME_RADIO = [
        '1' => 'Versão 1',
        '2' => 'Versão 2',
        '3' => 'Versão 3',
    ];

    public $table = 'companies';

    protected $appends = [
        'logo',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'vat',
        'address',
        'zip',
        'location',
        'country_id',
        'email',
        'theme',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function companyUsers()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function companyClients()
    {
        return $this->hasMany(Client::class, 'company_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function funnels()
    {
        return $this->belongsToMany(Funnel::class);
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

    public function getLogoAttribute()
    {
        $file = $this->getMedia('logo')->last();
        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview = $file->getUrl('preview');
        }

        return $file;
    }
}