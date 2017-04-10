<?php
/**
 * Generic Collection \Ds\Vector<array>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorArray extends VectorGenericCollection
{
    /**
     * @param array[] $data
     */
    public function __construct(array ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(array ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorArray
    {
        $data = $this->data->copy();
        return new VectorArray(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorArray
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorArray(...$data->toArray());
    }

    public function find(array $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): array
    {
        return $this->data->first();
    }

    public function get(int $index): array
    {
        return $this->data->get($index);
    }

    public function insert(int $index, array ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): array
    {
        return $this->data->last();
    }

    public function merge(array ...$values): VectorArray
    {
        $data = $this->data->merge($values);
        return new VectorArray(...$data->toArray());
    }

    public function map(callable $callback): VectorArray
    {
        $data = $this->data->map($callback);
        return new VectorArray(...$data->toArray());
    }

    public function pop(): array
    {
        return $this->data->pop();
    }

    public function push(array ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): array
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorArray
    {
        $data = $this->data->reversed();
        return new VectorArray(...$data->toArray());
    }

    public function set(int $index, array $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of array');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): array
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorArray
    {
        $data = $this->data->slice($index, $length);
        return new VectorArray(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorArray
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorArray(...$data->toArray());
    }

    public function unshift(array ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): array
    {
        return $this->data[$offset];
    }
}
