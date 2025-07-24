<?php

declare(strict_types=1);

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    public function searchTypeIdByIdUser(string $id);
    public function getDataEmployeeOrderByName();
    public function getAll();
}