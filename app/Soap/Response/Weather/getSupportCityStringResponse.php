<?php
namespace App\Soap\Response\Weather;

class getSupportCityStringResponse {
    protected $getSupportCityStringResult;

    public function __construct($getSupportCityStringResult) {
        $this->getSupportCityStringResult = $getSupportCityStringResult;
    }

    public function GetSupportCityStringResult() {
        return $this->getSupportCityStringResult;
    }
}
