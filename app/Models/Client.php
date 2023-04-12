<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'company_name',
        'email',
        'phone',
        'website',
        'company_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clientItems()
    {
        return $this->hasMany(Item::class, 'client_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
