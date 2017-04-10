<?php
/**
 * Generic Collection array<bool>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayBool extends ArrayGenericCollection
{
    /**
     * @param bool[] $data
     */
    public function __construct(bool ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): bool
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of bool');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): bool
    {
        return current($this->data);
    }
}
