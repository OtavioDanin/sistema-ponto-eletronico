<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\TypeEmployee;
use Illuminate\Database\Eloquent\Collection;

class TypeEmployeeRepository implements TypeEmployeeRepositoryInterface
{
    public function __construct(protected TypeEmployee $typeEmployee) {}

    public function getAll(): Collection
    {
        return $this->typeEmployee
            ->select('id', 'nome')
            ->get();
    }

    public function getById(string $id): TypeEmployee
    {
        return $this->typeEmployee
            ->select('id', 'nome')
            ->where('id', $id)
            ->first();
    }
}
