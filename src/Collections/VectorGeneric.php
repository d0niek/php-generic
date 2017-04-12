<?php

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
abstract class VectorGeneric implements \ArrayAccess, \Countable, \Iterator, \JsonSerializable, \Serializable
{
    /**
     * @var \Ds\Vector
     */
    protected $data;

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @param int $capacity
     */
    public function allocate(int $capacity): void
    {
        $this->data->allocate($capacity);
    }

    /**
     * @param callable $callback
     */
    public function apply(callable $callback): void
    {
        $this->data->apply($callback);
    }

    /**
     * @return int
     */
    public function capacity(): int
    {
        return $this->data->capacity();
    }

    public function clear(): void
    {
        $this->data->clear();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->data->count();
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->data->isEmpty();
    }

    /**
     * @param string $glue
     *
     * @return string
     */
    public function join(string $glue = ''): string
    {
        return $this->data->join($glue);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->data->toArray();
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param int $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @param callable $callback
     * @param mixed|null $initial
     *
     * @return mixed
     */
    public function reduce(callable $callback, $initial = null)
    {
        return $this->data->reduce($callback, $initial);
    }

    public function reverse(): void
    {
        $this->data->reverse();
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @param int $rotations
     */
    public function rotate(int $rotations): void
    {
        $this->data->rotate($rotations);
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return serialize($this->data);
    }

    /**
     * @param callable|null $comparator
     */
    public function sort(?callable $comparator = null): void
    {
        is_null($comparator) ?
            $this->data->sort() :
            $this->data->sort($comparator);
    }

    /**
     * @return int|float
     */
    public function sum()
    {
        return $this->data->sum();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data->toArray();
    }

    /**
     * @return \Ds\Vector
     */
    public function toVector(): Vector
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
        return !($this->position === $this->count());
    }
}
