<?php
namespace App\Soap\Response\Weather;

class getSupportCityDatasetResponse {
    protected $getSupportCityDatasetResult;

    public function __construct($getSupportCityDatasetResult) {
        $this->getSupportCityDatasetResult = $getSupportCityDatasetResult;
    }
    public function GetSupportCityDatasetResult() {
        return $this->getSupportCityDatasetResult;
    }
}
