<?php

namespace d0niek\GenericCollection\Service;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionGeneratorInterface
{
    /**
     * Generate generic collection
     *
     * @param string $type
     * @param string $namespace
     * @param string $collectionType
     *
     * @throws \InvalidArgumentException
     */
    public function generate(string $type, string $namespace, string $collectionType): void;
}
