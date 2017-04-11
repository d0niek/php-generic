<?php
/**
 * Generic Collection \Ds\Vector<GenericCollection>
 */

namespace d0niek\GenericCollection\Model\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGeneric;
use d0niek\GenericCollection\Model\GenericCollection;

final class VectorGenericCollection extends VectorGeneric
{
    /**
     * @param \d0niek\GenericCollection\Model\GenericCollection ...$data
     */
    public function __construct(GenericCollection ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(GenericCollection ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorGenericCollection
    {
        $data = $this->data->copy();
        return new VectorGenericCollection(...$data->toArray());
    }

    public function current(): GenericCollection
    {
        return $this->get($this->position);
    }

    public function filter(?callable $callback = null): ?VectorGenericCollection
    {
        $data = $this->data->filter($callback);
        return is_null($data) ?
            null :
            new VectorGenericCollection(...$data->toArray());
    }

    public function find(GenericCollection $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    public function first(): GenericCollection
    {
        return $this->data->first();
    }

    public function get(int $index): GenericCollection
    {
        return $this->data->get($index);
    }

    public function insert(int $index, GenericCollection ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): GenericCollection
    {
        return $this->data->last();
    }

    public function merge(GenericCollection ...$values): VectorGenericCollection
    {
        $data = $this->data->merge($values);
        return new VectorGenericCollection(...$data->toArray());
    }

    public function map(callable $callback): VectorGenericCollection
    {
        $data = $this->data->map($callback);
        return new VectorGenericCollection(...$data->toArray());
    }

    public function offsetGet($offset): GenericCollection
    {
        return $this->data[$offset];
    }

    public function pop(): GenericCollection
    {
        return $this->data->pop();
    }

    public function push(GenericCollection ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): GenericCollection
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorGenericCollection
    {
        $data = $this->data->reversed();
        return new VectorGenericCollection(...$data->toArray());
    }

    public function set(int $index, GenericCollection $value): void
    {
        $this->data->set($index, $value);
    }

    public function shift(): GenericCollection
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorGenericCollection
    {
        $data = $this->data->slice($index, $length);
        return new VectorGenericCollection(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorGenericCollection
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorGenericCollection(...$data->toArray());
    }

    public function unshift(GenericCollection ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
