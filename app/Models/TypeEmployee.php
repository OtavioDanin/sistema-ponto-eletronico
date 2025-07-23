<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEmployee extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'type_id');
    }
}
