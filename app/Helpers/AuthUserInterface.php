<?php

declare(strict_types=1);

namespace App\Helpers;

interface AuthUserInterface
{
    public function isUserAdmin(): bool;
    public function getIdUser(): ?int;
}
