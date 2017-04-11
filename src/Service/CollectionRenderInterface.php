<?php

namespace d0niek\GenericCollection\Service;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionRenderInterface
{
    /**
     * Render generic collection
     *
     * @param array $parameters
     * @param string $collectionType
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(array $parameters, string $collectionType): string;
}
