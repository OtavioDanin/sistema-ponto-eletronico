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

    public function getAll(): Collection
    {
        return $this->employee
            ->select('employees.id', 'employees.nome', 'employees.cargo', 'employees.status')
            ->get();
    }

    public function persist(array $data): Employee
    {
        return $this->employee::create($data);
    }

    public function findById(string $id, array $columns = ['*']): Collection
    {
        return $this->employee
            ->select($columns)
            ->join('type_employees', 'employees.type_id', '=', 'type_employees.id')
            ->where('employees.id', $id)
            ->get();
    }
}
