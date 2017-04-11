<?php

namespace d0niek\GenericCollection\Repository;

use d0niek\GenericCollection\Model\GenericCollection;
use d0niek\GenericCollection\Model\Collections\VectorGenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface GenericCollectionRepositoryInterface
{
    /**
     * Save generic collection
     *
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     */
    public function save(GenericCollection $genericCollection): void;

    /**
     * Find all generic collections
     *
     * @return \d0niek\GenericCollection\Model\Collections\VectorGenericCollection
     */
    public function findAll(): VectorGenericCollection;
}
