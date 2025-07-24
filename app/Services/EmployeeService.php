<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\EmployeeException;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService implements EmployeeServiceInterface
{
    public function __construct(protected EmployeeRepositoryInterface $employeeRepository) {}

    public function getDataEmployeeIdByIdUser(string $idUser): array
    {
        if ($idUser === '') {
            throw new EmployeeException('Usuário não encontrado', 404);
        }
        $type =  $this->employeeRepository->searchTypeIdByIdUser($idUser)->toArray();
        if(empty($type)) {
            throw new EmployeeException('Tipo de Funcionário não encontrado', 404);
        }
        return $type[0];
    }

    public function getDataEmployeeOrderByName(): Collection
    {
        return $this->employeeRepository->getDataEmployeeOrderByName();
    }
}
