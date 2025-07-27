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

    public function getById(int $id): ?User
    {
        return $this->user
            ->select()
            ->where('id', $id)
            ->first();
    }

    public function update(int $id, array $data): bool
    {
        $user = $this->getById($id);
        return $user->updateOrFail($data);
    }
}
