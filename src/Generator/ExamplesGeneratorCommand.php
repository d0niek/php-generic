<?php

namespace d0niek\GenericCollection\Generator;

use d0niek\GenericCollection\Example\User;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>=
 */
class ExamplesGeneratorCommand extends GeneratorCommand
{
    /**
     * @var string[]
     */
    private $exampleClass = [
        \Exception::class,
        User::class,
        '\\Not\\Existing\\ClassName'
    ];

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
        $namespace = 'd0niek\\GenericCollection\\Example\\Collections';

        foreach ($this->primitiveType as $type) {
            $data = [
                'type' => $type,
                'class' => $type,
                'namespace' => $namespace
            ];

            $this->generateCollection($data, 'Array');
            $this->generateCollection($data, 'Vector');
        }

        foreach ($this->exampleClass as $class) {
            $classInfo = $this->getClassInfo($class);
            $data = array_merge(['namespace' => $namespace], $classInfo);

            $this->generateCollection($data, 'Array');
            $this->generateCollection($data, 'Vector');
        }

        return 0;
    }
}
