<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_employee',
        'user_id',
        'created_by',
        'type_id',
        'nome',
        'cpf',
        'email',
        'senha',
        'cargo',
        'cep',
        'endereco',
        'data_nascimento',
        'data_admissao',
        'data_desligamento',
        'status',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'data_desligamento' => 'date',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function types(): BelongsTo
    {
        return $this->belongsTo(TypeEmployee::class, 'type_id');
    }

    public function timeRecords(): HasMany
    {
        return $this->hasMany(TimeRecord::class, 'employee_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }
}
