<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthUser implements AuthUserInterface
{
    const ADMIN_TYPE_ID = 1;

    public function isUserAdmin(): bool
    {
        $type_id = Auth::user()?->employees?->toArray()[0]['type_id'];
        if ($type_id !== self::ADMIN_TYPE_ID) {
            return false;
        }
        return true;
    }

    public function getIdUser(): ?int
    {
        $user = Auth::user();
        return $user->getAuthIdentifier();
    }

    public function checkIfUserSessionIsEmployeeCurrent(string $idEmployee): bool
    {
        return $idEmployee === Auth::user()?->employees?->toArray()[0]['id'];
    }
}
