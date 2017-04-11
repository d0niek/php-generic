<?php

namespace d0niek\GenericCollection\Collections;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
abstract class ArrayGenericCollection implements \ArrayAccess, \Iterator, \Countable, \Serializable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var int
     */
    protected $position = 0;

    public function count(): int
    {
        return count($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    public function next(): void
    {
        $this->position++;
        next($this->data);
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    public function rewind(): void
    {
        $this->position = 0;
        reset($this->data);
    }

    public function serialize(): string
    {
        return serialize($this->data);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function unserialize($serialized): void
    {
        $this->data = unserialize($serialized);
    }

    public function valid(): bool
    {
        return !($this->position === count($this->data));
    }
}
