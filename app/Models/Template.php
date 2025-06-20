<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{

    protected $fillable = [
        'name',
        'image_path',
        'image_cover',
        'is_paid',
        'usage_count'
    ];
    
    //
     public function designs()
    {
        return $this->hasMany(Design::class);
    }
}
