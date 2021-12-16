<?php
declare(strict_types = 1);

namespace Barwenock\CheckWeather\Model;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Barwenock\CheckWeather\Api\Data\DataInterface;
use Barwenock\CheckWeather\Api\Data\DataInterfaceFactory;
use Barwenock\CheckWeather\Model\ResourceModel\DataResource as ResourceWeather;
use Barwenock\CheckWeather\Api\Data\DataSearchResultInterface;
use Barwenock\CheckWeather\Api\ApiDataRepositoryInterface;
use Barwenock\CheckWeather\Model\ResourceModel\Weather\CollectionFactory;

class ApiDataRepository implements ApiDataRepositoryInterface
{

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var ResourceWeather
     */
    private ResourceWeather $resource;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var DataInterfaceFactory
     */
    private DataInterfaceFactory $dataInterfaceFactory;

    /**
     * @var SearchResultsInterface
     */
    private SearchResultsInterface $searchResultsFactory;

    /**
     * @param ResourceWeather $resource
     * @param DataInterfaceFactory $dataInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterface $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceWeather $resource,
        DataInterfaceFactory $dataInterfaceFactory,
        CollectionFactory $collectionFactory,
        SearchResultsInterface $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->dataInterfaceFactory = $dataInterfaceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(DataInterface $weather): DataInterface
    {
        try {
            $this->resource->save($weather);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the entity: %1',
                $exception->getMessage()
            ));
        }
        return $weather;
    }

    /**
     * @inheritDoc
     */
    public function get(string $entityId): DataInterface
    {
        $weatherModel = $this->dataInterfaceFactory->create();
        $this->resource->load($weatherModel, $entityId);
        if (!$weatherModel->getEntityId()) {
            throw new NoSuchEntityException(__('entity with id "%1" does not exist.', $entityId));
        }
        return $weatherModel;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): DataSearchResultInterface {
        try {
            $collection = $this->collectionFactory->create();
            $this->collectionProcessor->process($searchCriteria, $collection);
            $searchResults = $this->searchResultsFactory->create();
            $searchResults->setSearchCriteria($searchCriteria);

            $items = [];
            foreach ($collection as $model) {
                $items[] = $model;
            }

            $searchResults->setItems($items);
            $searchResults->setTotalCount($collection->getSize());
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(__('Could Not load factory'));
        }

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(DataInterface $weather): void
    {
        try {
            $weatherModel = $this->dataInterfaceFactory->create();
            $this->resource->load($weatherModel, $weather->getEntityId());
            $this->resource->delete($weatherModel);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the entity: %1',
                $exception->getMessage()
            ));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById(string $entityId): void
    {
        $this->delete($this->get($entityId));
    }
}
