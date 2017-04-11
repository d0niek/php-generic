<?php

namespace d0niek\GenericCollection\Command;

use d0niek\GenericCollection\Collections\GenericType;
use d0niek\GenericCollection\Model\GenericCollection;
use d0niek\GenericCollection\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class ArrayGeneratorCommand extends Command
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
        $this->setName('generate:array')
            ->setDescription('Generate generic array - array<type>()')
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
            )
            ->addOption(
                'saveCollection',
                's',
                InputOption::VALUE_OPTIONAL,
                'Save generated collection to generated-collections.json file.',
                true
            );
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');
        $namespace = $input->getArgument('namespace');
        $genericCollection = new GenericCollection($type, $namespace);
        $saveCollection = $input->getOption('saveCollection');

        if ($saveCollection !== true && $saveCollection !== 'true' && $saveCollection !== 'false') {
            throw new \InvalidArgumentException('Possible values for saveCollection option are true or false');
        }

        $saveCollection = $saveCollection === 'false' ? false : true;

        $this->collectionGenerator->generate($genericCollection, GenericType::ARRAY_TYPE, $saveCollection);

        return 0;
    }
}
