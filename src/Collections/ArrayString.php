<?php
/**
 * Generic Collection array<string>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayString extends ArrayGenericCollection
{
    /**
     * @param string[] $data
     */
    public function __construct(string ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): string
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_string($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of string');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): string
    {
        return current($this->data);
    }
}
