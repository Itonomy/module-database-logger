<?php

declare(strict_types=1);

namespace Itonomy\DatabaseLogger\Model;

use Itonomy\DatabaseLogger\Api\Data\EntityLogSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Entity Log search results.
 */
class EntityLogSearchResults extends SearchResults implements EntityLogSearchResultsInterface
{

}
