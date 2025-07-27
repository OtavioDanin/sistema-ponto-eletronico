<?php

declare(strict_types=1);

namespace App\Services;

interface TypeEmployeeServiceInterface
{
    public function getAll();
    public function getById(string $id);
}
