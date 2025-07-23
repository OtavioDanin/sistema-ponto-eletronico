<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\TimeRecordException;
use App\Helpers\AuthUserInterface;
use App\Repositories\TimeRecordRepositoryInterface;

class TimeRecordService implements TimeRecordServiceInterface
{
    public function __construct(protected TimeRecordRepositoryInterface $timeRecordRepository) {}

    public function create(array $dataTimeRecord): void
    {
        if (empty($dataTimeRecord)) {
            throw new TimeRecordException('Dados vazios para marcação de registro de ponto!', 400);
        }
        $this->timeRecordRepository->save($dataTimeRecord);
    }
}
