<?php
declare(strict_types = 1);

namespace Barwenock\CheckWeather\Api\Data;

interface DataManagementInterface
{

    /**
     * @return mixed
     */
    public function getCurrentWeatherData();

}
