<?php

namespace Barwenock\CheckWeather\Model;

use Magento\Framework\Model\AbstractModel;
use Barwenock\CheckWeather\Api\Data\DataInterface;
use Barwenock\CheckWeather\Model\ResourceModel\DataResource as Resource;

class DataModel extends AbstractModel implements DataInterface
{
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(Resource::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId(): ?string
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId): DataInterface
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getAirTemperature(): ?string
    {
        return $this->getData(self::AIR_TEMPERATURE);
    }

    /**
     * @inheritDoc
     */
    public function setAirTemperature(string $airTemperature): DataInterface
    {
        return $this->setData(self::AIR_TEMPERATURE, $airTemperature);
    }

    /**
     * @inheritDoc
     */
    public function getHumidity(): ?string
    {
        return $this->getData(self::HUMIDITY);
    }

    /**
     * @inheritDoc
     */
    public function setHumidity(string $humidity): DataInterface
    {
        return $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * @inheritDoc
     */
    public function getPressure(): ?string
    {
        return $this->getData(self::PRESSURE);
    }

    /**
     * @inheritDoc
     */
    public function setPressure(string $pressure): DataInterface
    {
        return $this->setData(self::PRESSURE, $pressure);
    }

    /**
     * @inheritDoc
     */
    public function getWindSpeed(): ?string
    {
        return $this->getData(self::WIND_SPEED);
    }

    /**
     * @inheritDoc
     */
    public function setWindSpeed(string $windSpeed): DataInterface
    {
        return $this->setData(self::WIND_SPEED, $windSpeed);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(string $createdAt): DataInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
