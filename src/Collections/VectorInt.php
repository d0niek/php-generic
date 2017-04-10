<?php
/**
 * Generic Collection \Ds\Vector<int>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorInt extends VectorGenericCollection
{
    /**
     * @param int[] $data
     */
    public function __construct(int ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(int ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorInt
    {
        $data = $this->data->copy();
        return new VectorInt(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorInt
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorInt(...$data->toArray());
    }

    public function find(int $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): int
    {
        return $this->data->first();
    }

    public function get(int $index): int
    {
        return $this->data->get($index);
    }

    public function insert(int $index, int ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): int
    {
        return $this->data->last();
    }

    public function merge(int ...$values): VectorInt
    {
        $data = $this->data->merge($values);
        return new VectorInt(...$data->toArray());
    }

    public function map(callable $callback): VectorInt
    {
        $data = $this->data->map($callback);
        return new VectorInt(...$data->toArray());
    }

    public function pop(): int
    {
        return $this->data->pop();
    }

    public function push(int ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): int
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorInt
    {
        $data = $this->data->reversed();
        return new VectorInt(...$data->toArray());
    }

    public function set(int $index, int $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of int');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): int
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorInt
    {
        $data = $this->data->slice($index, $length);
        return new VectorInt(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorInt
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorInt(...$data->toArray());
    }

    public function unshift(int ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): int
    {
        return $this->data[$offset];
    }
}
