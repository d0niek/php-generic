/**
 * Generic Collection \Ds\Vector<<?= $type ?>>
 */

namespace <?= $namespace ?>;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGenericCollection;
<?php if (isset($use) && $use !== '') { ?>
use <?= $use ?>\<?= $class ?>;
<?php } ?>

class Vector<?= $class ?> extends VectorGenericCollection
{
    /**
     * @param <?php
        if (isset($use) && $use !== '') {
            echo '\\', $use, '\\';
        }
        echo $type; ?>[] $data
     */
    public function __construct(<?= $type ?> ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(<?= $type ?> ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): Vector<?= $class, "\n" ?>
    {
        $data = $this->data->copy();
        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function current(): <?= $type, "\n" ?>
    {
        return $this->get($this->position);
    }

    public function filter(?callable $callback = null): ?Vector<?= $class, "\n" ?>
    {
        $data = $this->data->filter($callback);
        return is_null($data) ?
            null :
            new Vector<?= $class ?>(...$data->toArray());
    }

    public function find(<?= $type ?> $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    public function first(): <?= $type, "\n" ?>
    {
        return $this->data->first();
    }

    public function get(int $index): <?= $type, "\n" ?>
    {
        return $this->data->get($index);
    }

    public function insert(int $index, <?= $type ?> ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): <?= $type, "\n" ?>
    {
        return $this->data->last();
    }

    public function merge(<?= $type ?> ...$values): Vector<?= $class, "\n" ?>
    {
        $data = $this->data->merge($values);
        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function map(callable $callback): Vector<?= $class, "\n" ?>
    {
        $data = $this->data->map($callback);
        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function offsetGet($offset): <?= $type, "\n" ?>
    {
        return $this->data[$offset];
    }

    public function pop(): <?= $type, "\n" ?>
    {
        return $this->data->pop();
    }

    public function push(<?= $type ?> ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): <?= $type, "\n" ?>
    {
        return $this->data->remove($index);
    }

    public function reversed(): Vector<?= $class, "\n" ?>
    {
        $data = $this->data->reversed();
        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function set(int $index, <?= $type ?> $value): void
    {
        $this->data->set($index, $value);
    }

    public function shift(): <?= $type, "\n" ?>
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): Vector<?= $class, "\n" ?>
    {
        $data = $this->data->slice($index, $length);
        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): Vector<?= $class, "\n" ?>
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new Vector<?= $class ?>(...$data->toArray());
    }

    public function unshift(<?= $type ?> ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
