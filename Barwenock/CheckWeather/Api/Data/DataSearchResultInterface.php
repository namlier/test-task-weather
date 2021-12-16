<?php
declare(strict_types=1);

namespace Barwenock\CheckWeather\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DataSearchResultInterface extends SearchResultsInterface
{

    /**
     * Get api data items
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Set api data items
     *
     * @param array $items
     * @return DataSearchResultInterface
     */
    public function setItems(array $items): DataSearchResultInterface;
}
