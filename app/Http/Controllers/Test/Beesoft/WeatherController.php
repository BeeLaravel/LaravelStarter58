<?php
namespace App\Http\Controllers\Test\Beesoft;

use Beesoft\Weather\Weather;

class WeatherController extends Controller {
    public function city1(Weather $weather, $city, $type='base') { // /test/weather1/江夏/all
		return $weather->getWeather($city, $type);
    }
    public function city2($city, $type='base') { // /test/weather2/江夏/all
		return app('weather')->getWeather($city, $type);
    }
}
