<?php

namespace d0niek\Generic\Example;

use d0niek\Generic\Example\Collections\VectorUser;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface UserRepositoryInterface
{
    /**
     * @return \d0niek\Generic\Example\Collections\VectorUser
     */
    public function findAll(): VectorUser;
}
