<?php

namespace Barryvanveen\Users;

use Barryvanveen\Database\EloquentRepository;

class UserRepository extends EloquentRepository
{
    /**
     * Find a user by its email address.
     *
     * @param string $email
     *
     * @return User
     */
    public function findByEmail($email)
    {
        return User ::whereEmail($email)
                    ->first();
    }
}
