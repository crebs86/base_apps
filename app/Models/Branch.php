<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Branch extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = ['name', 'cnpj', 'email', 'address', 'cep', 'phones', 'notes', 'updated_at', 'created_at'];
}
