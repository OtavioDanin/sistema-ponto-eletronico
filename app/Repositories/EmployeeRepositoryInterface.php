<?php

declare(strict_types=1);

namespace App\Repositories;

interface EmployeeRepositoryInterface
{
    public function searchTypeIdByIdUser(string $id);
    public function getDataEmployeeOrderByName();
    public function getAll();
    public function persist(array $data);
    public function findById(string $id);
    public function update(string $id, array $data);
    public function delete(string $id);
    public function findByCreatedBy(string $id);
}