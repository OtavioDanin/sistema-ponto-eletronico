<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

class UniqueIdentifier implements UniqueIdentifierInterface
{
    public function generate(): string
    {
        return Str::uuid7()->toString();
    }
}
