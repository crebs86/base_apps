<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    protected $fillable = ['name', 'settings', 'updated_at'];
}
