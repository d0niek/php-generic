<?php
/**
 * Generic Collection \Ds\Vector<float>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorFloat extends VectorGenericCollection
{
    /**
     * @param float[] $data
     */
    public function __construct(float ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(float ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorFloat
    {
        $data = $this->data->copy();
        return new VectorFloat(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorFloat
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorFloat(...$data->toArray());
    }

    public function find(float $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): float
    {
        return $this->data->first();
    }

    public function get(int $index): float
    {
        return $this->data->get($index);
    }

    public function insert(int $index, float ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): float
    {
        return $this->data->last();
    }

    public function merge(float ...$values): VectorFloat
    {
        $data = $this->data->merge($values);
        return new VectorFloat(...$data->toArray());
    }

    public function map(callable $callback): VectorFloat
    {
        $data = $this->data->map($callback);
        return new VectorFloat(...$data->toArray());
    }

    public function pop(): float
    {
        return $this->data->pop();
    }

    public function push(float ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): float
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorFloat
    {
        $data = $this->data->reversed();
        return new VectorFloat(...$data->toArray());
    }

    public function set(int $index, float $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of float');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): float
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorFloat
    {
        $data = $this->data->slice($index, $length);
        return new VectorFloat(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorFloat
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorFloat(...$data->toArray());
    }

    public function unshift(float ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): float
    {
        return $this->data[$offset];
    }
}
