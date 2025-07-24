<?php

declare(strict_types=1);

namespace App\Repositories;

interface TimeRecordRepositoryInterface
{
    public function getDataByIdEmployee(string $idEmployee);
    public function save(array $dataTimeRecord);
    public function getTimeRecordEmployee();
}
