<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\TimeRecordException;
use App\Repositories\TimeRecordRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TimeRecordService implements TimeRecordServiceInterface
{
    public function __construct(
        protected TimeRecordRepositoryInterface $timeRecordRepository,
        ) {}

    public function create(array $dataTimeRecord): void
    {
        if (empty($dataTimeRecord)) {
            throw new TimeRecordException('Dados vazios para marcação de registro de ponto!', 400);
        }
        $this->timeRecordRepository->save($dataTimeRecord);
    }

    public function getDataByIdEmployee(string $idEmployee): Collection
    {
        if ($idEmployee === '') {
            throw new TimeRecordException('Id do Funcionário vazio!', 400);
        }
        return $this->timeRecordRepository->getDataByIdEmployee($idEmployee);
    }

    public function getTimeRecordEmployee(array $dataInput): LengthAwarePaginator
    {
        $builderQueryTimeRecord =  $this->timeRecordRepository->getTimeRecordEmployee();

        if (isset($dataInput['employee_id'])) {
            $builderQueryTimeRecord->where('employee_id', $dataInput['employee_id']);
        }
        if (isset($dataInput['start_date'])) {
            $startDate = Carbon::parse($dataInput['start_date'])->startOfDay();
            $builderQueryTimeRecord->where('recorded_at', '>=', $startDate);
        }
        if (isset($dataInput['end_date'])) {
            $endDate = Carbon::parse($dataInput['end_date'])->endOfDay();
            $builderQueryTimeRecord->where('recorded_at', '<=', $endDate);
        }
        return $builderQueryTimeRecord->paginate(25)->withQueryString();
    }
}
