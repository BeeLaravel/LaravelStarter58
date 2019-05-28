<?php
namespace App\Soap\Response\Weather;

class getRegionProvinceResponse {
    protected $getRegionProvinceResult;

    public function __construct($getRegionProvinceResult) {
        $this->getRegionProvinceResult = $getRegionProvinceResult;
    }
    public function GetRegionProvinceResult() {
        return $this->getRegionProvinceResult;
    }
}
