<?php

namespace d0niek\GenericCollection\Service;

use d0niek\GenericCollection\Collections\GenericType;
use d0niek\GenericCollection\Model\GenericCollection;
use d0niek\GenericCollection\Repository\GenericCollectionRepositoryInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class CollectionGenerator implements CollectionGeneratorInterface
{
    /**
     * @var string[]
     */
    private const PRIMITIVE_TYPE = ['bool', 'int', 'float', 'string', 'array'];

    /**
     * @var string[]
     */
    private const GENERIC_TYPE = [GenericType::ARRAY_TYPE, GenericType::VECTOR_TYPE];

    /**
     * @var \d0niek\GenericCollection\Service\CollectionRenderInterface
     */
    private $collectionRender;

    /**
     * @var \d0niek\GenericCollection\Service\CollectionWriterInterface
     */
    private $collectionWriter;

    /**
     * @var \d0niek\GenericCollection\Repository\GenericCollectionRepositoryInterface $genericCollectionRepository
     */
    private $genericCollectionRepository;

    /**
     * @param \d0niek\GenericCollection\Service\CollectionRenderInterface $collectionRender
     * @param \d0niek\GenericCollection\Service\CollectionWriterInterface $collectionWriter
     * @param \d0niek\GenericCollection\Repository\GenericCollectionRepositoryInterface $genericCollectionRepository
     */
    public function __construct(
        CollectionRenderInterface $collectionRender,
        CollectionWriterInterface $collectionWriter,
        GenericCollectionRepositoryInterface $genericCollectionRepository
    ) {
        $this->collectionRender = $collectionRender;
        $this->collectionWriter = $collectionWriter;
        $this->genericCollectionRepository = $genericCollectionRepository;
    }

    /**
     * @inheritDoc
     */
    public function generate(
        GenericCollection $genericCollection,
        string $collectionType,
        bool $saveCollection
    ): void {
        if (!in_array($collectionType, self::GENERIC_TYPE)) {
            throw new \InvalidArgumentException('Unknown generic colletion type "' . $collectionType . '"');
        }

        if (!in_array($genericCollection->getType(), self::PRIMITIVE_TYPE) && $genericCollection->getClass() === '') {
            $this->updateGenericCollectionType($genericCollection);
        }

        $class = $collectionType . ucfirst(str_replace('\\', '', $genericCollection->getType()));
        $genericCollection->setClass($class);

        $this->generateCollection($genericCollection, $collectionType);

        if ($saveCollection === true) {
            $this->genericCollectionRepository->save($genericCollection);
            echo "File generated-collections.json updated.\n";
        }
    }

    /**
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     */
    private function updateGenericCollectionType(GenericCollection $genericCollection): void
    {
        if (!class_exists($genericCollection->getType())) {
            echo 'Warning! Class "', $genericCollection->getType(), '" does not exists.', "\n";
        }

        $namespaceArray = explode('\\', $genericCollection->getType());
        if (!isset($namespaceArray[1])) {
            $genericCollection->setType('\\' . $genericCollection->getType());
            return;
        }

        $genericCollection->setUse($genericCollection->getType());
        $genericCollection->setType(end($namespaceArray));
    }

    /**
     * @param \d0niek\GenericCollection\Model\GenericCollection $genericCollection
     * @param string $collectionType
     *
     * @throws \ErrorException
     */
    private function generateCollection(GenericCollection $genericCollection, string $collectionType): void
    {
        $renderedCollecion = $this->collectionRender->render($genericCollection, $collectionType);
        $saveResult = $this->collectionWriter->write($genericCollection, $renderedCollecion);

        if ($saveResult === true) {
            echo 'New generic collection ', $collectionType, '<', $genericCollection->getType(), "> saved.\n";
            return;
        }

        throw new \ErrorException('Something went wrong during saving collection!');
    }

    /**
     * @inheritDoc
     */
    public function regenerate(): void
    {
        $genericCollestions = $this->genericCollectionRepository->findAll();
        foreach ($genericCollestions as $genericCollestion) {
            $collectionType = str_replace(ucfirst($genericCollestion->getType()), '', $genericCollestion->getClass());
            $this->generate($genericCollestion, $collectionType, false);
        }
    }
}
