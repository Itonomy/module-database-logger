<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Console\Command;

use Itonomy\DatabaseLogger\Model\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestLog extends Command
{
    /**
     * @var Logger
     */
    private Logger $logger;

    /**
     * @param Logger $logger
     * @param string|null $name
     */
    public function __construct(
        Logger $logger,
        string $name = null
    ) {
        parent::__construct($name);
        $this->logger = $logger;
    }

    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('test_log');
        $this->setDescription('tests database logger functionality');
        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $this->logger->info('test log message', ['test_var' => 'test']);
        $this->logger->info('test log message', ['test_var' => 'test', 'entity_type' => 'import', 'entity_id' => 99999]);

    }
}
