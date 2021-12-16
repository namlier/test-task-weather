<?php
declare(strict_types=1);

namespace Barwenock\CheckWeather\Cron;

use Magento\Framework\Exception\LocalizedException;
use Barwenock\CheckWeather\Api\Data\DataInterfaceFactory;
use Barwenock\CheckWeather\Api\ApiDataRepositoryInterface;
use Barwenock\CheckWeather\Model\ResourceModel\Weather\CollectionFactory;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;

class GetData
{
    public const API_URL_CONFIG_PATH = 'weather/settings/api_url';
    public const API_KEY_CONFIG_PATH = 'weather/settings/secret_key';

    /**
     * @var DataInterfaceFactory
     */
    private DataInterfaceFactory $dataFactory;

    /**
     * @var ApiDataRepositoryInterface
     */
    private ApiDataRepositoryInterface $weatherRepository;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;

    /**
     * @var Curl
     */
    private Curl $curl;

    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    /**
     * @var Json
     */
    private Json $json;

    /**
     * @param DataInterfaceFactory $dataFactory
     * @param ApiDataRepositoryInterface $weatherRepository
     * @param CollectionFactory $collectionFactory
     * @param Curl $curl
     * @param ScopeConfigInterface $scopeConfig
     * @param Json $json
     */
    public function __construct(
        DataInterfaceFactory    $dataFactory,
        ApiDataRepositoryInterface $weatherRepository,
        CollectionFactory          $collectionFactory,
        Curl $curl,
        ScopeConfigInterface $scopeConfig,
        Json $json
    ) {
        $this->dataFactory = $dataFactory;
        $this->weatherRepository = $weatherRepository;
        $this->collectionFactory = $collectionFactory;
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
        $this->json = $json;
    }

    /**
     * Get data from api
     *
     * @throws LocalizedException
     * @throws \Exception
     */
    public function execute():void
    {
        $url = $this->scopeConfig->getValue(self::API_URL_CONFIG_PATH) . "lat=51.2464536&lng=22.5684463&params=windSpeed,humidity,pressure,airTemperature&start=".time()."&end=".time();

        $options = [
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$this->scopeConfig->getValue(self::API_KEY_CONFIG_PATH)
            ],
        ];

        $this->curl->setOptions($options);
        $this->curl->get($url);
        $response = $this->curl->getBody();
        $data = $this->json->unserialize($response);
        $collection = $this->collectionFactory->create();
        $weather = $collection->getFirstItem();

        if (!$weather) {
            $weather = $this->dataFactory->create();
        }

        foreach ($data['hours'] as $item) {
            $weather->setData('air_temperature', $item['airTemperature']['sg']);
            $weather->setData('humidity', $item['humidity']['sg']);
            $weather->setData('pressure', $item['pressure']['sg']);
            $weather->setData('wind_speed', $item['windSpeed']['sg']);
            $weather->setData('updated_datetime', time());
            $this->weatherRepository->save($weather);
        }
    }
}
