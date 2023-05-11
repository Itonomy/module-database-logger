<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Api;

use Itonomy\DatabaseLogger\Api\Data\EntityLogInterface;
use Itonomy\DatabaseLogger\Api\Data\EntityLogSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

interface EntityLogRepositoryInterface
{
    /**
     * @param $id
     * @return EntityLogInterface
     */
    public function getById($id): EntityLogInterface;

    /**
     * @param $id
     * @return EntityLogInterface
     */
    public function getByLogEntityId($id): EntityLogInterface;


    /**
     * @param EntityLogInterface $entityLog
     * @return EntityLogInterface
     */
    public function save(EntityLogInterface $entityLog): EntityLogInterface;


    /**
     * Retrieve entity logs matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return EntityLogSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): EntityLogSearchResultsInterface;
}
