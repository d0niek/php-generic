<?php

namespace d0niek\GenericCollection\Example;

use d0niek\GenericCollection\Example\Collections\VectorUser;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * @return \d0niek\GenericCollection\Example\Collections\VectorUser
     */
    public function findAll(): VectorUser;
}
