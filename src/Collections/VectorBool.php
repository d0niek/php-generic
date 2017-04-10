<?php
/**
 * Generic Collection \Ds\Vector<bool>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorBool extends VectorGenericCollection
{
    /**
     * @param bool[] $data
     */
    public function __construct(bool ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(bool ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorBool
    {
        $data = $this->data->copy();
        return new VectorBool(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorBool
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorBool(...$data->toArray());
    }

    public function find(bool $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): bool
    {
        return $this->data->first();
    }

    public function get(int $index): bool
    {
        return $this->data->get($index);
    }

    public function insert(int $index, bool ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): bool
    {
        return $this->data->last();
    }

    public function merge(bool ...$values): VectorBool
    {
        $data = $this->data->merge($values);
        return new VectorBool(...$data->toArray());
    }

    public function map(callable $callback): VectorBool
    {
        $data = $this->data->map($callback);
        return new VectorBool(...$data->toArray());
    }

    public function pop(): bool
    {
        return $this->data->pop();
    }

    public function push(bool ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): bool
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorBool
    {
        $data = $this->data->reversed();
        return new VectorBool(...$data->toArray());
    }

    public function set(int $index, bool $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of bool');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): bool
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorBool
    {
        $data = $this->data->slice($index, $length);
        return new VectorBool(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorBool
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorBool(...$data->toArray());
    }

    public function unshift(bool ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): bool
    {
        return $this->data[$offset];
    }
}
