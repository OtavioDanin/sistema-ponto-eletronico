<?php

declare(strict_types=1);

namespace App\Repositories;

interface TimeRecordRepositoryInterface
{
    public function save(array $dataTimeRecord);
}
