<?php
/**
 * Generic Collection array<User>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;
use d0niek\GenericCollection\Example\User;

class ArrayUser extends ArrayGenericCollection
{
    /**
     * @param \d0niek\GenericCollection\Example\User[] $data
     */
    public function __construct(User ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): User
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof User) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of User');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): User
    {
        return current($this->data);
    }
}
