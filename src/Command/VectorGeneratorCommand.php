<?php

namespace d0niek\GenericCollection\Command;

use d0niek\GenericCollection\Collections\GenericType;
use d0niek\GenericCollection\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class VectorGeneratorCommand extends Command
{
    /**
     * @var \d0niek\GenericCollection\Service\CollectionGeneratorInterface
     */
    private $collectionGenerator;

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
        $this->setName('generate:vector')
            ->setDescription('Generate generic vector - \Ds\Vector<type>()')
            ->addArgument(
                'type',
                InputArgument::REQUIRED,
                "Type of generic vector. It can by bool, int, float, string, array \n" .
                "or full class namespace (remember to use \\\\ to separate names)."
            )
            ->addArgument(
                'namespace',
                InputArgument::REQUIRED,
                "Namespace of new generic vector."
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');
        $namespace = $input->getArgument('namespace');

        $this->collectionGenerator->generate($type, $namespace, GenericType::VECTOR_TYPE);

        return 0;
    }
}
