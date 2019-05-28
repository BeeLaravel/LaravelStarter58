<?php
namespace App\Soap\Response\Weather;

class getRegionCountryResponse {
    protected $getRegionCountryResult;

    public function __construct($getRegionCountryResult) {
        $this->getRegionCountryResult = $getRegionCountryResult;
    }
    public function GetRegionCountryResult() {
        return $this->getRegionCountryResult;
    }
}
