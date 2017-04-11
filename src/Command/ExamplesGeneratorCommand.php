<?php

namespace d0niek\GenericCollection\Command;

use d0niek\GenericCollection\Collections\GenericType;
use d0niek\GenericCollection\Example\User;
use d0niek\GenericCollection\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>=
 */
class ExamplesGeneratorCommand extends Command
{
    /**
    * @var \d0niek\GenericCollection\Service\CollectionGeneratorInterface
    */
    private $collectionGenerator;

    /**
     * @var string[]
     */
    private $primitiveType = ['bool', 'int', 'float', 'bool', 'array'];

    /**
     * @var string[]
     */
    private $classType = [
        \Exception::class,
        User::class,
        '\\Not\\Existing\\ClassName'
    ];

    /**
     * @var string
     */
    private $namespace = 'd0niek\\GenericCollection\\Example\\Collections';

    /**
     * @param \d0niek\GenericCollection\Service\CollectionGeneratorInterface $collectionGenerator
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
            $this->collectionGenerator->generate($type, $this->namespace, GenericType::ARRAY_TYPE);
            $this->collectionGenerator->generate($type, $this->namespace, GenericType::VECTOR_TYPE);
        }

        foreach ($this->classType as $class) {
            $this->collectionGenerator->generate($class, $this->namespace, GenericType::ARRAY_TYPE);
            $this->collectionGenerator->generate($class, $this->namespace, GenericType::VECTOR_TYPE);
        }

        return 0;
    }
}
