<?php

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
abstract class VectorGenericCollection implements \ArrayAccess, \Countable, \Iterator, \JsonSerializable, \Serializable
{
    /**
     * @var \Ds\Vector
     */
    protected $data;

    /**
     * @var int
     */
    protected $position = 0;

    public function allocate(int $capacity): void
    {
        $this->data->allocate($capacity);
    }

    public function apply(callable $callback): void
    {
        $this->data->apply($callback);
    }

    public function capacity(): int
    {
        return $this->data->capacity();
    }

    public function clear(): void
    {
        $this->data->clear();
    }

    public function count(): int
    {
        return $this->data->count();
    }

    public function isEmpty(): bool
    {
        return $this->data->isEmpty();
    }

    public function join(string $glue = ''): string
    {
        return $this->data->join($glue);
    }

    public function jsonSerialize(): array
    {
        return $this->data->toArray();
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetSet($offset, $value): void
    {
        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    public function reduce(callable $callback, $initial = null)
    {
        return $this->data->reduce($callback, $initial);
    }

    public function reverse(): void
    {
        $this->data->reverse();
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function rotate(int $rotations): void
    {
        $this->data->rotate($rotations);
    }

    public function serialize(): string
    {
        return serialize($this->data);
    }

    public function sort(?callable $comparator = null): void
    {
        is_null($comparator) ?
            $this->data->sort() :
            $this->data->sort($comparator);
    }

    public function sum()
    {
        return $this->data->sum();
    }

    public function toArray(): array
    {
        return $this->data->toArray();
    }

    public function toVector(): Vector
    {
        return $this->data;
    }

    public function unserialize($serialized): void
    {
        $this->data = unserialize($serialized);
    }

    public function valid(): bool
    {
        return !($this->position === $this->count());
    }
}
