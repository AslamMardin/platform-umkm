<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
     protected $fillable = [
        'user_id',
        'template_id',
        'image_path',
        'canvas_json'
    ];

    // Desain milik user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Desain berdasarkan template
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
