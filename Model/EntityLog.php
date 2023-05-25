<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model;

use Itonomy\DatabaseLogger\Api\Data\EntityLogInterface;
use Itonomy\DatabaseLogger\Model\ResourceModel\EntityLog as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class EntityLog extends AbstractModel implements EntityLogInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'entity_log_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getLogEntityType(): ?string
    {
        return $this->getData(self::LOG_ENTITY_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setLogEntityType(?string $logEntityType): void
    {
        $this->setData(self::LOG_ENTITY_TYPE, $logEntityType);
    }

    /**
     * @inheritDoc
     */
    public function getLogType(): string
    {
        return $this->getData(self::LOG_TYPE);
    }

    /**
     * @inheritDoc
     */
    public function setLogType(string $logType): void
    {
        $this->setData(self::LOG_TYPE, $logType);
    }

    /**
     * @inheritDoc
     */
    public function getLogEntityId(): string
    {
        return $this->getData(self::LOG_ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setLogEntityId(?string $logEntityId): void
    {
        $this->setData(self::LOG_ENTITY_ID, $logEntityId);
    }

    /**
     * @inheritDoc
     */
    public function getLogText(): string
    {
        return (string) $this->getData(self::LOG_TEXT);
    }

    /**
     * @inheritDoc
     */
    public function setLogText(string $logText): void
    {
        $this->setData(self::LOG_TEXT, $logText);
    }
}
