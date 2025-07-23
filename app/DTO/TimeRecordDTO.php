<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class TimeRecordDTO extends Data
{
    public ?string $unique_record;
    public ?string $employee_id;
    public ?string $recorded_at;
}
