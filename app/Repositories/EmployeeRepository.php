<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(protected Employee $employee) {}

    public function searchTypeIdByIdUser(string $idUser): Collection
    {
        return $this->employee->select('id', 'type_id')->where('user_id', $idUser)->get();
    }

    public function getDataEmployeeOrderByName(): Collection
    {
        return $this->employee->select('id', 'nome')->orderBy('nome')->get();
    }
}
