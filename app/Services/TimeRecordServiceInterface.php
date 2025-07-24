<?php

declare(strict_types=1);

namespace App\Services;

interface TimeRecordServiceInterface
{
    public function create(array $dataTimeRecord);
    public function getDataByIdEmployee(string $idEmployee);
}
