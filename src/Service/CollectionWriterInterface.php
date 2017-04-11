<?php

namespace d0niek\GenericCollection\Service;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionWriterInterface
{
    /**
     * Save generic collection to place pointed by namespace
     *
     * @param string $collection
     * @param string $namespace
     * @param string $class
     *
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function save(string $collection, string $namespace, string $class): bool;
}
