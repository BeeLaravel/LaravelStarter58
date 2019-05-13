<?php
namespace App\Http\Controllers\Beesoft;

use Illuminate\Http\Request;

use Beesoft\Weather\Weather;

class WeatherController extends Controller {
    public function show(Request $request, Weather $weather, $city) {
        return $weather->getWeather($city);
    }
    // public function show_second(Request $request, $city) {
    //     return app('weather')->getWeather($city);
    // }
}

