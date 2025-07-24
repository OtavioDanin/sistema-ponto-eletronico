<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\TimeRecord;
use Illuminate\Database\Eloquent\Collection;

class TimeRecordRepository implements TimeRecordRepositoryInterface
{
    public function __construct(protected TimeRecord $timeRecord) {}

    public function save(array $dataTimeRecord): TimeRecord
    {
        return $this->timeRecord->create($dataTimeRecord);
    }

    public function getDataByIdEmployee(string $idEmployee): Collection
    {
        return $this->timeRecord->select("employee_id", "recorded_at")
            ->where("employee_id", $idEmployee)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
