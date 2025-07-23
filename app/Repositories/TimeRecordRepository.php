<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\TimeRecord;

class TimeRecordRepository implements TimeRecordRepositoryInterface
{
    public function __construct(protected TimeRecord $timeRecord) {}

    public function save(array $dataTimeRecord): TimeRecord
    {
        return $this->timeRecord->create($dataTimeRecord);
    }
}
