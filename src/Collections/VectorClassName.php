<?php
/**
 * Generic Collection \Ds\Vector<ClassName>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;
use \Not\Existing\ClassName;

class VectorClassName extends VectorGenericCollection
{
    /**
     * @param \\Not\Existing\ClassName[] $data
     */
    public function __construct(ClassName ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(ClassName ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorClassName
    {
        $data = $this->data->copy();
        return new VectorClassName(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorClassName
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorClassName(...$data->toArray());
    }

    public function find(ClassName $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): ClassName
    {
        return $this->data->first();
    }

    public function get(int $index): ClassName
    {
        return $this->data->get($index);
    }

    public function insert(int $index, ClassName ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): ClassName
    {
        return $this->data->last();
    }

    public function merge(ClassName ...$values): VectorClassName
    {
        $data = $this->data->merge($values);
        return new VectorClassName(...$data->toArray());
    }

    public function map(callable $callback): VectorClassName
    {
        $data = $this->data->map($callback);
        return new VectorClassName(...$data->toArray());
    }

    public function pop(): ClassName
    {
        return $this->data->pop();
    }

    public function push(ClassName ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): ClassName
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorClassName
    {
        $data = $this->data->reversed();
        return new VectorClassName(...$data->toArray());
    }

    public function set(int $index, ClassName $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof ClassName) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of ClassName');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): ClassName
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorClassName
    {
        $data = $this->data->slice($index, $length);
        return new VectorClassName(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorClassName
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorClassName(...$data->toArray());
    }

    public function unshift(ClassName ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): ClassName
    {
        return $this->data[$offset];
    }
}
