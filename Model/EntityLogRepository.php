<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model;

use Itonomy\DatabaseLogger\Api\Data\EntityLogInterface;
use Itonomy\DatabaseLogger\Api\Data\EntityLogSearchResultsInterface;
use Itonomy\DatabaseLogger\Api\Data\EntityLogSearchResultsInterfaceFactory;
use Itonomy\DatabaseLogger\Api\EntityLogRepositoryInterface;
use Itonomy\DatabaseLogger\Model\ResourceModel\EntityLog\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class EntityLogRepository implements EntityLogRepositoryInterface
{
    /**
     * @var ResourceModel\EntityLog
     */
    private ResourceModel\EntityLog $resource;

    /**
     * @var EntityLogFactory
     */
    private EntityLogFactory $entityLogFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ResourceModel\EntityLog\CollectionFactory
     */
    private ResourceModel\EntityLog\CollectionFactory $collectionFactory;

    /**
     * @var EntityLogSearchResultsInterfaceFactory
     */
    private EntityLogSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @param ResourceModel\EntityLog $resource
     * @param CollectionFactory $collectionFactory
     * @param EntityLogSearchResultsInterfaceFactory $searchResultsFactory
     * @param EntityLogFactory $entityLogFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \Itonomy\DatabaseLogger\Model\ResourceModel\EntityLog $resource,
        CollectionFactory $collectionFactory,
        EntityLogSearchResultsInterfaceFactory $searchResultsFactory,
        EntityLogFactory $entityLogFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->entityLogFactory = $entityLogFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     */
    public function getById($id): EntityLogInterface
    {
        $entityLog = $this->entityLogFactory->create();
        $this->resource->load($entityLog, $id);
        if (!$entityLog->getId()) {
            throw new NoSuchEntityException(__('The Entity Log with the "%1" ID doesn\'t exist.', $id));
        }
        return $entityLog;
    }

    /**
     * @inheritDoc
     * @param $id
     * @return ResourceModel\EntityLog\Collection
     */
    public function getByLogEntityId($id): ResourceModel\EntityLog\Collection
    {
        return $this->collectionFactory->create()
            ->addFieldToFilter('log_entity_id', ['eq' => $id]);
    }

    /**
     * @param EntityLogInterface $entityLog
     * @return void
     * @throws CouldNotSaveException
     */
    public function save(EntityLogInterface $entityLog): EntityLogInterface
    {
        try {
            $this->resource->save($entityLog);
        } catch (\Throwable $exception) {
            throw new CouldNotSaveException(
                __('Could not save the page: %1', __('Something went wrong while saving the page.')),
                $exception
            );
        }

        return $entityLog;
    }

    /**
     * Load Entity Log data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param SearchCriteriaInterface $criteria
     * @return EntityLogSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria): EntityLogSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
