<?php
/**
 * Generic Collection \Ds\Vector<GenericCollection>
 */

namespace d0niek\Generic\Model\Collections;

use Ds\Vector;
use d0niek\Generic\Collections\VectorGeneric;
use d0niek\Generic\Model\GenericCollection;

final class VectorGenericCollection extends VectorGeneric
{
    /**
     * @param GenericCollection[] $data
     */
    public function __construct(GenericCollection ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param GenericCollection[] $values
     *
     * @return bool
     */
    public function contains(GenericCollection ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return VectorGenericCollection
     */
    public function copy(): VectorGenericCollection
    {
        $data = $this->data->copy();
        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @return GenericCollection
     */
    public function current(): GenericCollection
    {
        return $this->get($this->position);
    }

    /**
     * @param callable|null $callback
     *
     * @return VectorGenericCollection|null
     */
    public function filter(?callable $callback = null): ?VectorGenericCollection
    {
        $data = $this->data->filter($callback);
        return is_null($data) ?
            null :
            new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param GenericCollection $value
     *
     * @return int
     */
    public function find(GenericCollection $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return GenericCollection
     */
    public function first(): GenericCollection
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return GenericCollection
     */
    public function get(int $index): GenericCollection
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param GenericCollection[] $values
     */
    public function insert(int $index, GenericCollection ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return GenericCollection
     */
    public function last(): GenericCollection
    {
        return $this->data->last();
    }

    /**
     * @param GenericCollection[] $values
     *
     * @return VectorGenericCollection
     */
    public function merge(GenericCollection ...$values): VectorGenericCollection
    {
        $data = $this->data->merge($values);
        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return VectorGenericCollection
     */
    public function map(callable $callback): VectorGenericCollection
    {
        $data = $this->data->map($callback);
        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return GenericCollection
     */
    public function offsetGet($offset): GenericCollection
    {
        return $this->data[$offset];
    }

    /**
     * @param int $offset
     * @param GenericCollection $value
     */
    public function offsetSet($offset, $value): void
    {
        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return GenericCollection
     */
    public function pop(): GenericCollection
    {
        return $this->data->pop();
    }

    /**
     * @param GenericCollection[] $values
     */
    public function push(GenericCollection ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return GenericCollection
     */
    public function remove(int $index): GenericCollection
    {
        return $this->data->remove($index);
    }

    /**
     * @return VectorGenericCollection
     */
    public function reversed(): VectorGenericCollection
    {
        $data = $this->data->reversed();
        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param int $index
     * @param GenericCollection $value
     */
    public function set(int $index, GenericCollection $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return GenericCollection
     */
    public function shift(): GenericCollection
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return VectorGenericCollection
     */
    public function slice(int $index, ?int $length = null): VectorGenericCollection
    {
        $data = $this->data->slice($index, $length);
        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return VectorGenericCollection
     */
    public function sorted(?callable $comparator = null): VectorGenericCollection
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorGenericCollection(...$data->toArray());
    }

    /**
     * @param GenericCollection[] $values
     */
    public function unshift(GenericCollection ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
