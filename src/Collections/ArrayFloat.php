<?php
/**
 * Generic Collection array<float>
 */

namespace d0niek\GenericCollection\Collections;

use d0niek\GenericCollection\Collections\ArrayGenericCollection;

class ArrayFloat extends ArrayGenericCollection
{
    /**
     * @param float[] $data
     */
    public function __construct(float ...$data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): float
    {
        return $this->data[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value ' . gettype($value) . ' is not instance of float');
        }

        is_null($offset) ?
            $this->data[] = $value :
            $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function current(): float
    {
        return current($this->data);
    }
}
