<?php

namespace Barwenock\CheckWeather\Model;

use Barwenock\CheckWeather\Api\Data\DataManagementInterface;
use Barwenock\CheckWeather\Model\ResourceModel\Weather\CollectionFactory;
use Magento\Framework\Serialize\Serializer\Json;

class DataManagement implements DataManagementInterface
{
    private ResourceModel\Weather\CollectionFactory $collectionFactory;
    private Json $json;

    /**
     * @param ResourceModel\Weather\CollectionFactory $collectionFactory
     * @param Json $json
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Json $json
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->json = $json;
    }

    public function getCurrentWeatherData()
    {
        $collection = $this->collectionFactory->create();
        $data = $collection->getFirstItem();
        return $this->json->serialize($data->getData());
    }
}
