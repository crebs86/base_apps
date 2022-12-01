<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Client extends Model
{

    protected $fillable = ['name', 'email', 'cpf', 'cep', 'address', 'phones', 'notes'];

    use HasFactory, HasRoles, SoftDeletes;

    public function branch()
    {
        return $this->hasOne(Branch::class, 'id', 'branch_id');
    }
}
