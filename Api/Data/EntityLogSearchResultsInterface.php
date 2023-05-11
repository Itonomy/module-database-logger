<?php
namespace Itonomy\DatabaseLogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for entity log search results.
 */
interface EntityLogSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return EntityLogInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param EntityLogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
