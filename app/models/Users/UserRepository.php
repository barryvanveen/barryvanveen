<?php namespace Barryvanveen\Users;

class UserRepository {

    /**
     * Find a user by its email address
     *
     * @param string $email
     * @return User
     */
    public function findByEmail($email) {
        return User::	whereEmail($email)
                        ->first();
    }

}