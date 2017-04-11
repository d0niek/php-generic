<?php

namespace d0niek\GenericCollection\Example;

use d0niek\GenericCollection\Example\Collections\VectorUser;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAll(): VectorUser
    {
        $users = new VectorUser();
        $mysqli = new \mysqli('localhost:3306', 'user', 'password', 'db');

        $mysqliResult = $mysqli->query('SELECT id, name FROM users LIMIT 10');
        if ($mysqliResult !== false) {
            while (($user = $mysqliResult->fetch_object(User::class)) !== null) {
                $users->push($user);
            }
        }

        $mysqli->close();

        return $users;
    }
}
