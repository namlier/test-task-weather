<?php
declare(strict_types = 1);

namespace Barwenock\CheckWeather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Barwenock\CheckWeather\Api\Data\DataSearchResultInterface;
use Barwenock\CheckWeather\Api\Data\DataInterface;
use Magento\Framework\Exception\LocalizedException;

interface ApiDataRepositoryInterface
{

    /**
     * Save entity
     *
     * @param DataInterface $weather
     * @return DataInterface
     * @throws LocalizedException
     */
    public function save(
        DataInterface $weather
    ): DataInterface;

    /**
     * Retrieve entity
     *
     * @param string $entityId
     * @return DataInterface
     * @throws LocalizedException
     */
    public function get(string $entityId): Data\DataInterface;

    /**
     * Retrieve entity matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchSearchCriteria
     * @return DataSearchResultInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchSearchCriteria
    ): DataSearchResultInterface;

    /**
     * Delete entity
     *
     * @param DataInterface $weather
     * @return void
     * @throws LocalizedException
     */
    public function delete(
        DataInterface $weather
    ): void;

    /**
     * Delete entity by ID
     *
     * @param string $entityId
     * @return void
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(string $entityId): void;
}
