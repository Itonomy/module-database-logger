<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class EntityLog extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'entity_log_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('entity_log', 'id');
        $this->_useIsObjectNew = true;
    }
}
