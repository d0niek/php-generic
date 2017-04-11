/**
 * Generic Collection array<<?= $genericCollection->getType() ?>>
 */

namespace <?= $genericCollection->getNamespace() ?>;

use d0niek\GenericCollection\Collections\ArrayGeneric;
<?= $genericCollection->getUse() !== '' ? 'use ' . $genericCollection->getUse() . ";\n" : '' ?>

final class <?= $genericCollection->getClass() ?> extends ArrayGeneric
{
    /**
     * @param <?= $genericCollection->getUse() !== '' ?
                      '\\' . $genericCollection->getUse() :
                      $genericCollection->getType() ?> ...$data
     */
    public function __construct(<?= $genericCollection->getType() ?> ...$data)
    {
        $this->data = $data;
    }

    public function current(): <?= $genericCollection->getType(), "\n" ?>
    {
        return current($this->data);
    }

    public function offsetGet($offset): <?= $genericCollection->getType(), "\n" ?>
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        if (!<?= $this->getTypeCheckStatement($genericCollection->getType()) ?>) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of <?= $genericCollection->getType() ?>');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }
}
