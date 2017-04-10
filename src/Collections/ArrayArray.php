<?php
/**
 * Generic Collection array<array>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayArray extends ArrayGenericCollection
{
    /**
     * @param array[] $data
     */
    public function __construct(array ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): array
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of array');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): array
    {
        return current($this->data);
    }
}
