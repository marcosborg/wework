<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'items';

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

    public function lastInput()
    {
        return $this->hasMany(Input::class, 'item_id', 'id')->orderBy('id', 'desc')->limit(1);
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
}
