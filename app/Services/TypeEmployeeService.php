<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TypeEmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TypeEmployeeService implements TypeEmployeeServiceInterface
{
    public function __construct(protected TypeEmployeeRepositoryInterface $typeEmployeeService) {}

    public function getAll(): Collection
    {
        return $this->typeEmployeeService->getAll();
    }

    public function getById(string $id): array
    {
        $typeEmployee = $this->typeEmployeeService->getById($id);
        return $typeEmployee->toArray();

    }
}
