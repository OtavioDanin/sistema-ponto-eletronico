<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class TimeRecordInputDTO extends Data
{
    public ?string $employee_id;
    public ?string $start_date;
    public ?string $end_date;
}
