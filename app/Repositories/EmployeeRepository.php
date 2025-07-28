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

    public function findById(string $id): ?Employee
    {
        return $this->employee
            ->select()
            ->where('id', $id)
            ->first();
    }

    public function update(string $id, array $data): bool
    {
        $employee = $this->findById($id);
        return $employee->updateOrFail($data);
    }

    public function delete(string $id): Employee
    {
        $employee = $this->findById($id);
        $employee->deleteOrFail();
        return $employee;
    }

    public function findByCreatedBy(string $id): ?Employee
    {
        return $this->employee
            ->select()
            ->where('created_by', $id)
            ->first();
    }
}
