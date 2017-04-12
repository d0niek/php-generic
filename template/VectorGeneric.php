/**
 * Generic Collection \Ds\Vector<<?= $genericCollection->getType() ?>>
 */

namespace <?= $genericCollection->getNamespace() ?>;

use Ds\Vector;
use d0niek\Generic\Collections\VectorGeneric;
<?= $genericCollection->getUse() !== '' ? 'use ' . $genericCollection->getUse() . ";\n" : '' ?>

final class <?= $genericCollection->getClass() ?> extends VectorGeneric
{
    /**
     * @param <?= $genericCollection->getType() ?>[] $data
     */
    public function __construct(<?= $genericCollection->getType() ?> ...$data)
    {
        $this->data = new Vector($data);
    }

    /**
     * @param <?= $genericCollection->getType() ?>[] $values
     *
     * @return bool
     */
    public function contains(<?= $genericCollection->getType() ?> ...$values): bool
    {
        return $this->data->contains(...$values);
    }

    /**
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function copy(): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->copy();
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function current(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->get($this->position);
    }

    /**
     * @param callable|null $callback
     *
     * @return <?= $genericCollection->getClass() ?>|null
     */
    public function filter(?callable $callback = null): ?<?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->filter($callback);
        return is_null($data) ?
            null :
            new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param <?= $genericCollection->getType() ?> $value
     *
     * @return int
     */
    public function find(<?= $genericCollection->getType() ?> $value): int
    {
        $index = $this->data->find($value);
        return $index !== false ?
            $index :
            -1;
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function first(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->first();
    }

    /**
     * @param int $index
     *
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function get(int $index): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->get($index);
    }

    /**
     * @param int $index
     * @param <?= $genericCollection->getType() ?>[] $values
     */
    public function insert(int $index, <?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->insert($index, ...$values);
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function last(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->last();
    }

    /**
     * @param <?= $genericCollection->getType() ?>[] $values
     *
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function merge(<?= $genericCollection->getType() ?> ...$values): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->merge($values);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param callable $callback
     *
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function map(callable $callback): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->map($callback);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param int $offset
     *
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function offsetGet($offset): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data[$offset];
    }

    /**
     * @param int $offset
     * @param <?= $genericCollection->getType() ?> $value
     */
    public function offsetSet($offset, $value): void
    {
        is_null($offset) ?
            $this->data->push($value) :
            $this->data->set($offset, $value);
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function pop(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->pop();
    }

    /**
     * @param <?= $genericCollection->getType() ?>[] $values
     */
    public function push(<?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->push(...$values);
    }

    /**
     * @param int $index
     *
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function remove(int $index): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->remove($index);
    }

    /**
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function reversed(): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->reversed();
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param int $index
     * @param <?= $genericCollection->getType() ?> $value
     */
    public function set(int $index, <?= $genericCollection->getType() ?> $value): void
    {
        $this->data->set($index, $value);
    }

    /**
     * @return <?= $genericCollection->getType(), "\n" ?>
     */
    public function shift(): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data->shift();
    }

    /**
     * @param int $index
     * @param int|null $length
     *
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function slice(int $index, ?int $length = null): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = $this->data->slice($index, $length);
        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param callable|null $comparator
     *
     * @return <?= $genericCollection->getClass(), "\n" ?>
     */
    public function sorted(?callable $comparator = null): <?= $genericCollection->getClass(), "\n" ?>
    {
        $data = is_null($comparator) ?
            $this->data->sorted() :
            $this->data->sorted($comparator);

        return new <?= $genericCollection->getClass() ?>(...$data->toArray());
    }

    /**
     * @param <?= $genericCollection->getType() ?>[] $values
     */
    public function unshift(<?= $genericCollection->getType() ?> ...$values): void
    {
        $this->data->unshift(...$values);
    }
}
