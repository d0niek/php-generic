<?php

namespace d0niek\Generic\Collections;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
abstract class ArrayGeneric implements \ArrayAccess, \Iterator, \Countable, \Serializable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->position++;
        next($this->data);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
        reset($this->data);
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return serialize($this->data);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        $this->data = unserialize($serialized);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return !($this->position === count($this->data));
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return [
            'data' => $this->data,
        ];
    }

    /**
     * @param callable $filter
     *
     * @return $this
     */
    public function filter(callable $filter)
    {
        $this->data = \array_filter($this->data, $filter);

        return $this;
    }
}
