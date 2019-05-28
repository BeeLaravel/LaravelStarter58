<?php
namespace App\Soap\Request\Weather;

class getWeather {
	protected $theCityCode;

	public function __construct($theCityCode) {
		$this->theCityCode = $theCityCode;
	}

	public function getTheCityCode() {
		return $this->theCityCode;
	}
}
