<?php

namespace d0niek\Generic\Service;

use d0niek\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionRenderInterface
{
    /**
     * Render generic collection
     *
     * @param \d0niek\Generic\Model\GenericCollection $genericCollection
     * @param string $collectionType
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(GenericCollection $genericCollection, string $collectionType): string;
}
