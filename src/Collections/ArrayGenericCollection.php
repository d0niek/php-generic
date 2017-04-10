<?php

namespace d0niek\GenericCollection\Collections;

abstract class ArrayGenericCollection implements \ArrayAccess, \Iterator, \Countable, \Serializable
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        next($this->data);
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        reset($this->data);
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        return serialize($this->data);
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized): void
    {
        $this->data = unserialize($serialized);
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return current($this->data);
    }
}
