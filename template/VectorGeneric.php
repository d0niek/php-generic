/**
 * Generic Collection \Ds\Vector<<?= $genericCollection->getType() ?>>
 */

namespace <?= $genericCollection->getNamespace() ?>;

use Ds\Vector;
use d0niek\GenericCollection\Collections\VectorGeneric;
<?= $genericCollection->getUse() !== '' ? 'use ' . $genericCollection->getUse() . ";\n" : '' ?>

final class <?= $genericCollection->getClass() ?> extends VectorGeneric
{
    /**
     * @param <?= $genericCollection->getUse() !== '' ?
                      '\\' . $genericCollection->getUse() :
                      $genericCollection->getType() ?> ...$data
     */
    public function __construct(<?= $genericCollection->getType() ?> ...$data)
    {
        $this->data = new Vector($data);
    }

    public function contains(<?= $genericCollection->getType() ?> ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    public function copy(): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->copy();
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function current(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->get($this->position);
    }

    public function filter(?callable $callback = null): ?<?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->filter($callback);
        return is_null($data) ?
            null :
            new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function find(<?= $genericCollection->getType() ?> $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    public function first(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->first();
    }

    public function get(int $index): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->get($index);
    }

    public function insert(int $index, <?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    public function last(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->last();
    }

    public function merge(<?= $genericCollection->getType() ?> ...$values): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->merge($values);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function map(callable $callback): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->map($callback);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function offsetGet($offset): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data[$offset];
    }

    public function pop(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->pop();
    }

    public function push(<?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->push(...$values);
    }

    public function remove(int $index): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->remove($index);
    }

    public function reversed(): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->reversed();
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function set(int $index, <?= $genericCollection->getType() ?> $value): void
    {
        $this->data->set($index, $value);
    }

    public function shift(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->shift();
    }

    public function slice(int $index, ?int $length = null): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->slice($index, $length);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function sorted(?callable $comparator = null): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    public function unshift(<?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
