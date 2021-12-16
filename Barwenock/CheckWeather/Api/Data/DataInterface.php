<?php
declare(strict_types = 1);

namespace Barwenock\CheckWeather\Api\Data;

interface DataInterface
{
    public const ENTITY_ID = 'entity_id';
    public const AIR_TEMPERATURE = 'air_temperature';
    public const HUMIDITY = 'humidity';
    public const PRESSURE = 'pressure';
    public const WIND_SPEED = 'wind_speed';
    public const CREATED_AT = 'created_at';

    /**
     * Get entity_id
     *
     * @return string|null
     */
    public function getEntityId(): ?string;

    /**
     * Set entity_id
     *
     * @param string|null $entityId
     * @return DataInterface
     */
    public function setEntityId(?string $entityId): self;

    /**
     * Get temperature
     *
     * @return string|null
     */
    public function getAirTemperature(): ?string;

    /**
     * Set air temperature
     *
     * @param string $airTemperature
     * @return DataInterface
     */
    public function setAirTemperature(string $airTemperature): self;

    /**
     * Get humidity
     *
     * @return string|null
     */
    public function getHumidity(): ?string;

    /**
     * Set humidity
     *
     * @param string $humidity
     * @return DataInterface
     */
    public function setHumidity(string $humidity): self;

    /**
     * Get pressure
     *
     * @return string|null
     */
    public function getPressure(): ?string;

    /**
     * Set pressure
     *
     * @param string $pressure
     * @return DataInterface
     */
    public function setPressure(string $pressure): self;

    /**
     * Get humidity
     *
     * @return string|null
     */
    public function getWindSpeed(): ?string;

    /**
     * Set Wind Speed
     *
     * @param string $windSpeed
     * @return DataInterface
     */
    public function setWindSpeed(string $windSpeed): self;
     /**
     * Get humidity
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Set Wind Speed
     *
     * @param string $createdAt
     * @return DataInterface
     */
    public function setCreatedAt(string $createdAt): self;
}
