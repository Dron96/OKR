<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performers extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_results_id'
    ];

    public function keyResult()
    {
        return $this->hasOne(KeyResult::class, 'id', 'key_results_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
