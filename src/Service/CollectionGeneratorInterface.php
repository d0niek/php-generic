<?php

namespace d0niek\GenericCollection\Service;

use d0niek\GenericCollection\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
interface CollectionGeneratorInterface
{
    /**
     * Generate generic collection
     *
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     * @param string $collectionType
     * @param bool $saveCollection
     *
     * @throws \InvalidArgumentException
     */
    public function generate(
        GenericCollection $genericCollection,
        string $collectionType,
        bool $saveCollection
    ): void;

    /**
     * Regenerat collections from generated-collections.json file
     */
    public function regenerate(): void;
}
