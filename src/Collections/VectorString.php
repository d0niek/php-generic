<?php
/**
 * Generic Collection \Ds\Vector<string>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorString extends VectorGenericCollection
{
    /**
     * @param string[] $data
     */
    public function __construct(string ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(string ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorString
    {
        $data = $this->data->copy();
        return new VectorString(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorString
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorString(...$data->toArray());
    }

    public function find(string $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): string
    {
        return $this->data->first();
    }

    public function get(int $index): string
    {
        return $this->data->get($index);
    }

    public function insert(int $index, string ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): string
    {
        return $this->data->last();
    }

    public function merge(string ...$values): VectorString
    {
        $data = $this->data->merge($values);
        return new VectorString(...$data->toArray());
    }

    public function map(callable $callback): VectorString
    {
        $data = $this->data->map($callback);
        return new VectorString(...$data->toArray());
    }

    public function pop(): string
    {
        return $this->data->pop();
    }

    public function push(string ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): string
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorString
    {
        $data = $this->data->reversed();
        return new VectorString(...$data->toArray());
    }

    public function set(int $index, string $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of string');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): string
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorString
    {
        $data = $this->data->slice($index, $length);
        return new VectorString(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorString
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorString(...$data->toArray());
    }

    public function unshift(string ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): string
    {
        return $this->data[$offset];
    }
}
