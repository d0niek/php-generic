<?php
/**
 * Generic Collection array<ClassName>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;
use \Not\Existing\ClassName;

class ArrayClassName extends ArrayGenericCollection
{
    /**
     * @param \\Not\Existing\ClassName[] $data
     */
    public function __construct(ClassName ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): ClassName
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof ClassName) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of ClassName');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): ClassName
    {
        return current($this->data);
    }
}
