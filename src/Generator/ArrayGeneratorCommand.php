<?php

namespace d0niek\GenericCollection\Generator;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class ArrayGeneratorCommand extends GeneratorCommand
{
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->setName('generate:array')
            ->setDescription('Generate generic array collection - array<type>()')
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                "Type of generic array. It can by bool, int, float, string, array \n" .
                "or full class namespace (remember to use \\\\ to separate names)."
            )
            ->addArgument(
                'namespace',
                InputArgument::REQUIRED,
                "Namespace of new generic array."
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $value = $this->executeParent($input, $output, 'Array');

        return $value;
    }
}
