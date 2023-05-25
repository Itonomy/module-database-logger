<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model\Handler;

use Itonomy\DatabaseLogger\Model\EntityLogRepository;
use Itonomy\DatabaseLogger\Model\EntityLogFactory;
use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractHandler;
use Monolog\Handler\FormattableHandlerInterface;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class DatabaseHandler extends AbstractHandler implements FormattableHandlerInterface
{
    /**
     * PSR-3 compliant logger
     *
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var FormatterInterface|null
     */
    protected ?FormatterInterface $formatter;

    /**
     * @var EntityLogRepository
     */
    private EntityLogRepository $entityLogRepository;

    /**
     * @var EntityLogFactory
     */
    private EntityLogFactory $entityLogFactory;

    /**
     * @param EntityLogRepository $entityLogRepository
     * @param EntityLogFactory $entityLogFactory
     * @param int $level
     * @param bool $bubble
     */
    public function __construct(
        EntityLogRepository $entityLogRepository,
        EntityLogFactory $entityLogFactory,
        $level = Logger::DEBUG,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
        $this->setFormatter(new \Monolog\Formatter\LineFormatter("%message% %context%"));
        $this->entityLogRepository = $entityLogRepository;
        $this->entityLogFactory = $entityLogFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function handle(array $record): bool
    {
        if (!$this->isHandling($record) || !$this->getFormatter()) {
            return false;
        }

        /* @var \Itonomy\DatabaseLogger\Api\Data\EntityLogInterface $entityLog */
        $entityLog = $this->entityLogFactory->create();
        $logEntityType = $logEntityId = null;
        if (\array_key_exists('entity_type', $record['context']) ?? $record['context']['entity_type']) {
            $logEntityType = $record['context']['entity_type'];
            unset($record['context']['entity_type']);
        }
        if (\array_key_exists('entity_id', $record['context']) ?? $record['context']['entity_id']) {
            $logEntityId = $record['context']['entity_id'];
            unset($record['context']['entity_id']);
        }
        $formatted = $this->formatter->format($record);
        $data = [
            'log_type' => (string) $record['level_name'],
            'log_entity_type' => (string) $logEntityType,
            'log_entity_id' => (string) $logEntityId,
            'log_text' => (string) $formatted
        ];

        $entityLog->setData($data);
        $this->entityLogRepository->save($entityLog);
        return false === $this->bubble;
    }

    /**
     * Sets the formatter.
     *
     * @param FormatterInterface $formatter
     * @return HandlerInterface
     */
    public function setFormatter(FormatterInterface $formatter): HandlerInterface
    {
        $this->formatter = $formatter;

        return $this;
    }

    /**
     * Gets the formatter.
     *
     * @return FormatterInterface
     */
    public function getFormatter(): FormatterInterface
    {
        if (!$this->formatter) {
            throw new \LogicException('No formatter has been set and this handler does not have a default formatter');
        }

        return $this->formatter;
    }
}
