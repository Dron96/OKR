<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeyResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'percent',
        'weight',
        'goal_id',
        'executor'
    ];

    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id', 'id');
    }

    public function performers()
    {
        return $this->hasMany(Performers::class, 'key_result_id', 'id');
    }
}
