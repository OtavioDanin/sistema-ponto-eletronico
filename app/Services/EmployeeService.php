<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\EmployeeException;
use App\Helpers\AuthUserInterface;
use App\Helpers\UniqueIdentifierInterface;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeService implements EmployeeServiceInterface
{
    public function __construct(
        protected EmployeeRepositoryInterface $employeeRepository,
        protected UserRepositoryInterface $userRepository,
        protected UniqueIdentifierInterface $unique,
        protected AuthUserInterface $auth,
    ) {}

    public function getDataEmployeeIdByIdUser(string $idUser): array
    {
        if ($idUser === '') {
            throw new EmployeeException('Usuário não encontrado', 404);
        }
        $type =  $this->employeeRepository->searchTypeIdByIdUser($idUser)->toArray();
        if (empty($type)) {
            throw new EmployeeException('Tipo de Funcionário não encontrado', 404);
        }
        return $type[0];
    }

    public function getDataEmployeeOrderByName(): Collection
    {
        return $this->employeeRepository->getDataEmployeeOrderByName();
    }

    public function getAll(): Collection
    {
        return $this->employeeRepository->getAll();
    }

    public function save(array $data)
    {
        if (empty($data)) {
            throw new EmployeeException('Dados vazios para cadsatro!', 400);
        }
        DB::transaction(function () use ($data) {
            $dataUser = [
                'name' => $data['nome'],
                'email' => $data['email'],
                'password' => Hash::make($data['senha']),
            ];
            $user = $this->userRepository->persist($dataUser);
            $data['user_id'] = $user->id;
            $data['created_by'] = $this->auth->getIdUser();
            $data['unique_employee'] = $this->unique->generate();
            $this->employeeRepository->persist($data);
        });
    }

    public function getById(string $id): array
    {
        $employee = $this->employeeRepository->findById($id);
        return $employee->toArray();
    }

    public function update(string $id, array $data): void
    {
        DB::transaction(function () use ($id, $data) {
            $this->updateEmployee($id, $data);
            $this->updateUser($this->getDataEmployee($id));
        });
    }

    public function delete(string $id): void
    {
        $this->checkRulesToDelete($id);
        DB::transaction(function () use ($id) {
            $employee = $this->employeeRepository->delete($id);
            $employeeData = $employee->toArray();
            $this->userRepository->delete($employeeData['user_id']);
        });
    }

    public function checkRulesToDelete(string $id): bool
    {
        $employeeyCreatedBy = $this->employeeRepository->findByCreatedBy($id);
        if (isset($employeeyCreatedBy)) {
            throw new EmployeeException('Não é permitido remover funcionário com dependentes');
        }
        if ($this->auth->checkIfUserSessionIsEmployeeCurrent($id)) {
            throw new EmployeeException('Não é permitido se auto-remover');
        }
        return true;
    }

    private function updateEmployee(string $id, array $data): void
    {
        $this->employeeRepository->update($id, $data);
    }

    private function getDataEmployee(string $id): array
    {
        $employee = $this->employeeRepository->findById($id);
        return $employee->toArray();
    }

    private function updateUser(array $employeeData): void
    {
        $this->userRepository->update($employeeData['user_id'], ['name' => $employeeData['nome'], 'email' => $employeeData['email']]);
    }
}
