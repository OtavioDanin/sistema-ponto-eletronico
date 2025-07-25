<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(protected User $user) {}

    public function persist(array $data): User
    {
        return $this->user::create($data);
    }
}
