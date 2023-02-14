<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use SoftDeletes;
    use HasFactory;

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
}
