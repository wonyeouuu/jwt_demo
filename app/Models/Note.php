<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
