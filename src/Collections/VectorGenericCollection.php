<?php

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;

abstract class VectorGenericCollection implements \IteratorAggregate, \Countable, \JsonSerializable, \ArrayAccess
{
    /**
     * @var \Ds\Vector
     */
    protected $data;

    /**
     * @return \Ds\Vector
     */
    public function toVector(): Vector
    {
        return $this->data;
    }

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

    public function reduce(callable $callback, $initial = null)
    {
        return $this->data->reduce($callback, $initial);
    }

    public function reverse(): void
    {
        $this->data->reverse();
    }

    public function rotate(int $rotations): void
    {
        $this->data->rotate($rotations);
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

    public function jsonSerialize(): array
    {
        return $this->data->toArray();
    }

    public function getIterator(): \Generator
    {
        foreach ($this->data as $value) {
            yield $value;
        }
    }

    /**
     * @inheritdoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritdoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }
}
