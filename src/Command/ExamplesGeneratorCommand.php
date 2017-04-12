<?php

namespace d0niek\Generic\Command;

use d0niek\Generic\Collections\GenericType;
use d0niek\Generic\Example\User;
use d0niek\Generic\Model\GenericCollection;
use d0niek\Generic\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>=
 */
class ExamplesGeneratorCommand extends Command
{
    /**
    * @var \d0niek\Generic\Service\CollectionGeneratorInterface
    */
    private $collectionGenerator;

    /**
     * @var string[]
     */
    private $primitiveType = ['bool', 'int', 'float', 'bool', 'array'];

    /**
     * @var string[]
     */
    private $complexType = [
        \Exception::class,
        User::class,
        '\\Not\\Existing\\ClassName'
    ];

    /**
     * @var string
     */
    private $namespace = 'd0niek\\GenericCollection\\Example\\Collections';

    /**
     * @param \d0niek\Generic\Service\CollectionGeneratorInterface $collectionGenerator
     */
    public function __construct(CollectionGeneratorInterface $collectionGenerator)
    {
        $this->collectionGenerator = $collectionGenerator;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName('generate:examples')
            ->setDescription('Generate example generic collections.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach ($this->primitiveType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::ARRAY_TYPE, false);

            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }

        foreach ($this->complexType as $type) {
            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::ARRAY_TYPE, false);

            $genericCollection = new GenericCollection($type, $this->namespace);
            $this->collectionGenerator->generate($genericCollection, GenericType::VECTOR_TYPE, false);
        }

        return 0;
    }
}
