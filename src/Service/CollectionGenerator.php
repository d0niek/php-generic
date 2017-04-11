<?php

namespace d0niek\GenericCollection\Service;

use d0niek\GenericCollection\Collections\GenericType;

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
     * @param \d0niek\GenericCollection\Service\CollectionRenderInterface $collectionRender
     * @param \d0niek\GenericCollection\Service\CollectionWriterInterface $collectionWriter
     */
    public function __construct(
        CollectionRenderInterface $collectionRender,
        CollectionWriterInterface $collectionWriter
    ) {
        $this->collectionRender = $collectionRender;
        $this->collectionWriter = $collectionWriter;
    }

    /**
     * @inheritDoc
     */
    public function generate(string $type, string $namespace, string $collectionType): void
    {
        if (!in_array($collectionType, self::GENERIC_TYPE)) {
            throw new \InvalidArgumentException('Unknown generic colletion type "' . $collectionType . '"');
        }

        $data = [
            'type' => $type,
            'class' => $type,
            'namespace' => $namespace
        ];

        if (!in_array($type, self::PRIMITIVE_TYPE)) {
            $data = $this->updateDataFromClassFullname($data);
        }

        $data['class'] = $collectionType . ucfirst(str_replace('\\', '', $data['type']));

        $this->generateCollection($data, $collectionType);
    }

    /**
     * @param string[] $data
     *
     * @return string[]
     */
    private function updateDataFromClassFullname(array $data): array
    {
        if (!class_exists($data['class'])) {
            echo 'Warning! Class "', $data['class'], '" does not exists.', "\n";
        }

        $namespaceArray = explode('\\', $data['type']);
        if (!isset($namespaceArray[1])) {
            $data['type'] = '\\' . $data['type'];
            return $data;
        }

        $data['use'] = $data['type'];
        $data['type'] = end($namespaceArray);

        return $data;
    }

    /**
     * @param string[] $data
     * @param string $collectionType
     *
     * @throws \ErrorException
     */
    private function generateCollection(array $data, string $collectionType): void
    {
        $genericCollection = $this->collectionRender->render($data, $collectionType);
        $saveResult = $this->collectionWriter->save($genericCollection, $data['namespace'], $data['class']);

        if ($saveResult === true) {
            echo 'New generic collection ', $collectionType, '<', $data['type'], "> saved.\n";
            return;
        }

        throw new \ErrorException('Something went wrong during saving collection!');
    }
}
