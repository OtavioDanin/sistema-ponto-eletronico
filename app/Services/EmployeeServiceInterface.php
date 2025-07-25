<?php

declare(strict_types=1);

namespace App\Services;

interface EmployeeServiceInterface
{
    public function getDataEmployeeIdByIdUser(string $id);
    public function getDataEmployeeOrderByName();
    public function getAll();
    public function save(array $data);
}