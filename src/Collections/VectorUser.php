<?php
/**
 * Generic Collection \Ds\Vector<User>
 */

namespace d0niek\GenericCollection\Collections;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;
use d0niek\GenericCollection\Example\User;

class VectorUser extends VectorGenericCollection
{
    /**
     * @param \d0niek\GenericCollection\Example\User[] $data
     */
    public function __construct(User ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(User ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): VectorUser
    {
        $data = $this->data->copy();
        return new VectorUser(...$data->toArray());
    }

    public function filter(?callable $callback = null): ?VectorUser
    {
        $data = $this->data->filter($callback);
        return $data === null ? null : new VectorUser(...$data->toArray());
    }

    public function find(User $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ? $index : -1;
    }

    public function first(): User
    {
        return $this->data->first();
    }

    public function get(int $index): User
    {
        return $this->data->get($index);
    }

    public function insert(int $index, User ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): User
    {
        return $this->data->last();
    }

    public function merge(User ...$values): VectorUser
    {
        $data = $this->data->merge($values);
        return new VectorUser(...$data->toArray());
    }

    public function map(callable $callback): VectorUser
    {
        $data = $this->data->map($callback);
        return new VectorUser(...$data->toArray());
    }

    public function pop(): User
    {
        return $this->data->pop();
    }

    public function push(User ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): User
    {
        return $this->data->remove($index);
    }

    public function reversed(): VectorUser
    {
        $data = $this->data->reversed();
        return new VectorUser(...$data->toArray());
    }

    public function set(int $index, User $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof User) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of User');
        }

        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    public function shift(): User
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): VectorUser
    {
        $data = $this->data->slice($index, $length);
        return new VectorUser(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): VectorUser
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new VectorUser(...$data->toArray());
    }

    public function unshift(User ...$values): void
    {
        $this->data->unshift(...$values);
    }

    /**
     * @inheritdoc
     */
    public function offsetGet($offset): User
    {
        return $this->data[$offset];
    }
}
