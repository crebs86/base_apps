<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Client extends Model
{
    use HasFactory, HasRoles, SoftDeletes;

    protected $fillable = ['name', 'email', 'cpf', 'cep', 'address', 'phones', 'branch_id', 'notes', 'updated_at', 'created_at'];

    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
