<?php
namespace App\Soap\Response\Weather;

class getWeatherResponse {
    protected $getWeatherResult;

    public function __construct($getWeatherResult) {
        $this->getWeatherResult = $getWeatherResult;
    }
    public function GetWeatherResult() {
        return $this->getWeatherResult;
    }
}
