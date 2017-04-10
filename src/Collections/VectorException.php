<?php
/**
 * Generic Collection \Ds\Vector<\Exception>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;

class VectorException extends VectorGenericCollection
{
    /**
     * @param \Exception[] $data
     */
    public function __construct(\Exception ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(\Exception ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorException
    {
        $data = $this->data->copy();
        return new VectorException(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorException
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorException(...$data->toArray());
    }

    public function find(\Exception $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): \Exception
    {
        return $this->data->first();
    }

    public function get(int $index): \Exception
    {
        return $this->data->get($index);
    }

    public function insert(int $index, \Exception ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): \Exception
    {
        return $this->data->last();
    }

    public function merge(\Exception ...$values): VectorException
    {
        $data = $this->data->merge($values);
        return new VectorException(...$data->toArray());
    }

    public function map(callable $callback): VectorException
    {
        $data = $this->data->map($callback);
        return new VectorException(...$data->toArray());
    }

    public function pop(): \Exception
    {
        return $this->data->pop();
    }

    public function push(\Exception ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): \Exception
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorException
    {
        $data = $this->data->reversed();
        return new VectorException(...$data->toArray());
    }

    public function set(int $index, \Exception $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof \Exception) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of \Exception');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): \Exception
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorException
    {
        $data = $this->data->slice($index, $length);
        return new VectorException(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorException
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorException(...$data->toArray());
    }

    public function unshift(\Exception ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): \Exception
    {
        return $this->data[$offset];
    }
}
