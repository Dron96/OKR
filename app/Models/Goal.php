<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KeyResult;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'descr',
        'executor',
        'author',
        'dateStart',
        'dateEnd',
        'percentOfCompletion',
        'command'
        ];

    public function keyResults()
    {
        return $this->hasMany(KeyResult::class, 'goal_id', 'id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function executor()
    {
        return $this->belongsTo('User', 'executor', 'id');
    }
}
