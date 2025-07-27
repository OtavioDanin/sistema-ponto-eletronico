<?php

declare(strict_types=1);

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function persist(array $data);
    public function getById(int $id);
    public function update(int $id, array $data);
}
