<?php

declare(strict_types=1);

namespace App\Helpers;

interface UniqueIdentifierInterface
{
    public function generate(): string;
}
