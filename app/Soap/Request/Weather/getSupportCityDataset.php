<?php
namespace App\Soap\Request\Weather;

class getSupportCityDataset {
	protected $theRegionCode;

	public function __construct($theRegionCode) {
		$this->theRegionCode = $theRegionCode;
	}

	public function getTheRegionCode() {
		return $this->theRegionCode;
	}
}
