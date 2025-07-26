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

    public function getById(string $id, array $columns = ['*']): Collection
    {
        return $this->employeeRepository->findById($id, $columns);
    }
}
