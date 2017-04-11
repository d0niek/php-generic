<?php

namespace d0niek\GenericCollection\Command;

use d0niek\GenericCollection\Service\CollectionGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class RegeneratCollectionsCommand extends Command
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
        $this->setName('collections:regenerate')
            ->setDescription('Regenerate collections from generated-collections.json file.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->collectionGenerator->regenerate();

        return 0;
    }
}
