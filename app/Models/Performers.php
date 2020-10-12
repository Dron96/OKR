<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performers extends Model
{
    use HasFactory;

    public function keyResult()
    {
        return $this->belongsTo('Performers', 'key_result_id', 'id');
    }
}
