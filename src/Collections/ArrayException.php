<?php
/**
 * Generic Collection array<\Exception>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayException extends ArrayGenericCollection
{
    /**
     * @param \Exception[] $data
     */
    public function __construct(\Exception ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): \Exception
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!$value instanceof \Exception) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of \Exception');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): \Exception
    {
        return current($this->data);
    }
}
