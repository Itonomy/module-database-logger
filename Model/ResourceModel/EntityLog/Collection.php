<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model\ResourceModel\EntityLog;

use Itonomy\DatabaseLogger\Model\EntityLog as Model;
use Itonomy\DatabaseLogger\Model\ResourceModel\EntityLog as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'entity_log_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
