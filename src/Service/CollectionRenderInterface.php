<?php

namespace d0niek\GenericCollection\Service;

use d0niek\GenericCollection\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionRenderInterface
{
    /**
     * Render generic collection
     *
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     * @param string $collectionType
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(GenericCollection $genericCollection, string $collectionType): string;
}
