<?php

namespace d0niek\Generic\Repository;

use d0niek\Generic\Model\GenericCollection;
use d0niek\Generic\Model\Collections\VectorGenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface GenericCollectionRepositoryInterface
{
    /**
     * Save generic collection
     *
     * @param \d0niek\Generic\Model\GenericCollection $genericCollection
     */
    public function save(GenericCollection $genericCollection): void;

    /**
     * Find all generic collections
     *
     * @return \d0niek\Generic\Model\Collections\VectorGenericCollection
     */
    public function findAll(): VectorGenericCollection;
}
