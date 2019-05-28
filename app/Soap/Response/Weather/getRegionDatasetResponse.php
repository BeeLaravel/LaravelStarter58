<?php
namespace App\Soap\Response\Weather;

class getRegionDatasetResponse {
    protected $getRegionDatasetResult;

    public function __construct($getRegionDatasetResult) {
        $this->getRegionDatasetResult = $getRegionDatasetResult;
    }
    public function GetRegionDatasetResult() {
        return $this->getRegionDatasetResult;
    }
}
