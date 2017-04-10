/**
 * Generic Collection array<<?= $type ?>>
 */

namespace <?= $namespace ?>;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;
<?php if (isset($use) && $use !== '') { ?>
use <?= $use ?>\<?= $class ?>;
<?php } ?>

class Array<?= $class ?> extends ArrayGenericCollection
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
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): <?= $type, "\n" ?>
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!<?= $this->getTypeCheckStatement($type) ?>) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of <?= $type ?>');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): <?= $type, "\n" ?>
    {
        return current($this->data);
    }
}
