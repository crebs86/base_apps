<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AclUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'updates', 'updated_at'];

    public $timestamps = false;
}
