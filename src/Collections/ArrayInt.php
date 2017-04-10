<?php
/**
 * Generic Collection array<int>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayInt extends ArrayGenericCollection
{
    /**
     * @param int[] $data
     */
    public function __construct(int ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): int
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of int');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): int
    {
        return current($this->data);
    }
}
